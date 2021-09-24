<?php


namespace App\Service;


use App\Entity\Passe;
use App\Predict\Predict;
use App\Predict\PredictException;
use App\Predict\PredictQTH;
use App\Predict\PredictSat;
use App\Predict\PredictTime;
use App\Predict\PredictTLE;
use App\TimezoneMapper;
use DateInterval;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class SattelliteCalculation
 * Calculate data of a sattelite
 * @package App\Service
 */
class SattelliteCalculation
{

    private Request|null $request;
    private ParameterBagInterface $params;

    public function __construct(RequestStack $requestStack, ParameterBagInterface $params)
    {

        $this->request = $requestStack->getCurrentRequest();
        $this->params = $params;
    }

    /**
     * Function that return an array, one with all the passes, and one with all the passes sort by date
     * @param float $lat
     * @param float $lon
     * @param int $maxdt
     * @param array|null $tleFile
     * @return array[]
     * @throws PredictException
     */
    #[ArrayShape(['totalPasses' => "array", 'passes' => "array"])] public function getVisiblePasses(float $lat, float $lon, int $maxdt = 15, array $tleFile = null): array
    {

        if (is_null($tleFile)) {
            $tleFile = $this->getIssTleFile();
        }

        $timeZone = TimezoneMapper::latLngToTimezoneString($lat, $lon);
        date_default_timezone_set($timeZone);
        $predict = new Predict();
        $qth = new PredictQTH();
        $qth->alt = 0;
        $qth->lat = $lat;
        $qth->lon = $lon;


        $tle = new PredictTLE($tleFile[0], $tleFile[1], $tleFile[2]);

        $sat = new PredictSat($tle);
        $now = PredictTime::get_current_daynum();
        $results = $predict->get_passes($sat, $qth, $now, $maxdt);
        $filtered = $predict->filterVisiblePasses($results);

        $format = 'H:i:s';
        $fomatExact = 'm/d/y H:i:s';
        if ($this->request->getLocale() === "fr") {
            $formatDate = 'fr';
        } else {
            $formatDate = 'l j F Y';
        }

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


            if ($duration > 0) {
                $totalPasses[] = [
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

                $passes[$date][] = new Passe($index, $date, $dateStart, $dateStartExact, $dateMax, $dateEnd, $dateEndExact, $azStart, $azMax, $azEnd, $azStartDegres, $azMaxDegres, $azEndDegres, $duration, $mag,$timeZone, $coord);
                $index++;
            }
        }


        return [
            'totalPasses' => $totalPasses,
            'passes' => $passes
        ];
    }


    /**
     * @param array $tleFile
     * @param float $lat
     * @param float $lon
     * @return array
     * @throws PredictException
     */
    public
    function realTime(float $lat, float $lon, array $tleFile = null): array
    {
        if (is_null($tleFile)) {
            $tleFile = $this->getIssTleFile();

        }

        $latLon = array();
        $qth = new PredictQTH();
        $qth->lat = $lat;
        $qth->lon = $lon;

        $tle = new PredictTLE($tleFile[0], $tleFile[1], $tleFile[2]); // Instantiate it
        $sat = new PredictSat($tle); // Load up the satellite data
        $date = new DateTime();
        $interval = new DateInterval('PT10S');
        $intervalHourAndHalf = new DateInterval('PT45M');
        $date->sub($intervalHourAndHalf);
        $predict = new Predict();

        for ($i = 0; $i < 810; $i++) {
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

    /**
     * Get the ISS Tle File
     * @return bool|array
     */
    private function getIssTleFile(): bool|array
    {
        $rootPath = $this->params->get('kernel.project_dir');
        return file($rootPath . '/src/Predict/iss.tle');
    }


}