<?php


namespace App\Service;


use App\Passes\Passe;
use App\Predict\Predict;
use App\Predict\PredictException;
use App\Predict\PredictQTH;
use App\Predict\PredictSat;
use App\Predict\PredictTime;
use App\Predict\PredictTLE;
use App\TimezoneMapper;
use DateInterval;
use DateTime;

class SattelliteCalculation
{

    /**
     * Function that return an array, one with all the passes, and one with all the passes sort by date
     * @param array $tleFile
     * @param float $lat
     * @param float $lon
     * @return array[]
     * @throws PredictException
     */
    public function getVisiblePasses(array $tleFile, float $lat, float $lon): array
    {

        $timeZone = TimezoneMapper::latLngToTimezoneString($lat, $lon);
        date_default_timezone_set($timeZone);
        $predict = new Predict();
        $qth = new PredictQTH();
        $qth->alt = 0;
        $qth->lat = floatval($lat);
        $qth->lon = floatval($lon);


        $tle = new PredictTLE($tleFile[0], $tleFile[1], $tleFile[2]);

        $sat = new PredictSat($tle);
        $now = PredictTime::get_current_daynum();
        $results = $predict->get_passes($sat, $qth, $now, 15);
        $filtered = $predict->filterVisiblePasses($results);

        $format = 'H:i:s';
        $fomatExact = 'm/d/y H:i:s';
        $formatDate = 'fr';

        $passes = array();
        $totalPasses = array();
        $index = 0;
        foreach ($filtered as $pass) {
            $date = PredictTime::daynum2readable($pass->visible_aos, $timeZone, $formatDate);
            $dateStart = PredictTime::daynum2readable($pass->visible_aos, $timeZone, $format);
            $dateStartExact = PredictTime::daynum2readable($pass->visible_aos, $timeZone, $fomatExact);
            $dateMax = PredictTime::daynum2readable($pass->visible_tca, $timeZone, $format);
            $dateEnd = PredictTime::daynum2readable($pass->visible_los, $timeZone, $format);
            $dateEndExact = PredictTime::daynum2readable($pass->visible_los, $timeZone, $fomatExact);

            $azStart = str_replace('W', 'O', $predict->azDegreesToDirection($pass->visible_aos_az));
            $azMax = str_replace('W', 'O', $predict->azDegreesToDirection($pass->visible_max_el_az));
            $azEnd = str_replace('W', 'O', $predict->azDegreesToDirection($pass->visible_los_az));


            $azStartDegres = floor($pass->visible_aos_az);
            $azMaxDegres = floor($pass->visible_max_el_az);
            $azEndDegres = floor($pass->visible_los_az);

            $duration = floor(($pass->visible_los - $pass->visible_aos) * 86400);
            $mag = number_format($pass->max_apparent_magnitude, 1);

            $detailsPasse = $pass->details;
            $coord = array();
            foreach ($detailsPasse as $detail) {
                $coord[] = [
                    "lat" => $detail->lat,
                    "lon" => $detail->lon
                ];
            }


            $detailsPasseSort = array();
            if ($duration > 0) {
                $detailsPasseSort[] = [
                    'date' => $date,
                    'dateStart' => $dateStart,
                    'dateMax' => $dateMax,
                    'dateEnd' => $dateEnd,
                    'azStart' => $azStart,
                    'azMax' => $azMax,
                    'azEnd' => $azEnd,
                    'azStartDegres' => $azStartDegres,
                    'azMaxDegres' => $azMaxDegres,
                    'azEndDegres' => $azEndDegres,
                    'duration' => $duration,
                    'mag' => $mag,
                    'coord' => $coord
                ];

                $totalPasses[] = $detailsPasseSort;
                $passes[$date][] = new Passe($dateStart, $dateStartExact, $dateMax, $dateEnd, $dateEndExact, $azStart, $azMax, $azEnd, $azStartDegres, $azMaxDegres, $azEndDegres, $duration, $mag, $coord, $index);
                $index++;
            }
        }

        return [
            'totalPasses' =>$totalPasses,
            'passes' => $passes
        ];
    }


    public function realTime(array $tleFile, float $lat, float $lon): array
    {
        $latLon = array();
        $qth = new PredictQTH();
        $qth->lat = floatval($lat);
        $qth->lon = floatval($lon);

        $tle = new PredictTLE($tleFile[0], $tleFile[1], $tleFile[2]); // Instantiate it
        $sat = new PredictSat($tle); // Load up the satellite data
        $date = new DateTime();
        $interval = new DateInterval('PT10S');
        $intervalHourAndHalf = new DateInterval('PT45M');
        $date->sub($intervalHourAndHalf);
        $predict = new Predict();

        for ($i = 0; $i < 810; $i++){
            $now = PredictTime::getCurrentDaynumFromUnix($date->format('U')); // get the current time as Julian Date (daynum)
            $predict->predict_calc($sat, $qth, $now);
            $latLon[$i] = [
                'lat' => $sat->ssplat,
                'lon' => $sat->ssplon
            ];
            $date->add($interval);
        }


        return $latLon;



    }


}