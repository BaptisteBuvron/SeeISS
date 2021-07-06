<?php

namespace App\Controller;

use App\Service\GetLocationService;
use App\Service\IpInformation;
use App\Service\SattelliteCalculation;
use App\TimezoneMapper;
use Mpdf\Mpdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var SattelliteCalculation
     */
    private $sattelliteCalculation;
    /**
     * @var IpInformation
     */
    private IpInformation $ipInformation;
    /**
     * @var GetLocationService
     */
    private GetLocationService $locationService;

    /**
     * HomeController constructor.
     */
    public function __construct(SattelliteCalculation $sattelliteCalculation, IpInformation $ipInformation, GetLocationService $locationService)
    {

        $this->sattelliteCalculation = $sattelliteCalculation;
        $this->ipInformation = $ipInformation;
        $this->locationService = $locationService;
    }


    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {


        $coord = $this->locationService->getLatLonCity();
        $lat = $coord['lat'];
        $lon = $coord['lon'];
        $cityName = $coord['cityName'];
        $passes = null;
        $totalPasses = null;
        $info = [
            'lat' => $lat,
            'lon' => $lon,
            'city' => $cityName
        ];
        if (!is_null($lat) && !is_null($lon)){
            $res = $this->sattelliteCalculation->getVisiblePasses(floatval($lat), floatval($lon));
            $totalPasses = $res['totalPasses'];
            $passes = $res['passes'];
        }





        return $this->render('home/index.html.twig', [
            'passes' => $passes,
            'totalPasses' => $totalPasses,
            'info' => $info
        ]);
    }

    /**
     * @Route("/live", name="live")
     * @throws \App\Predict\PredictException
     */
    public function live()
    {
        $coord = $this->locationService->getLatLonCity();
        $lat = $coord['lat'];
        $lon = $coord['lon'];
        // Only once per day
        $timeZone = TimezoneMapper::latLngToTimezoneString($lat, $lon);
        date_default_timezone_set($timeZone);


        $latLonArray = $this->sattelliteCalculation->realTime($lat, $lon);

/*
        $kph = $sat->velo * 60 * 60;


        $zone = new \DateTimezone($timeZone);
        $date = new \DateTime();
        $date->setTimezone($zone);
        $date->setTimestamp(PredictTime::daynum2unix(PredictTime::get_current_daynum()));
        $time = $date->format('m-d-Y g:i:s a T');

        echo "ISS Current Position: \n\n";
        echo "    Latitude:  " . $sat->ssplat . "\n";
        echo "    Longitude: " . $sat->ssplon . "\n";
        echo "    Altitude:  " . number_format($sat->alt * Predict::km2mi, 2) . ' miles up' . "\n";
        echo "    Velocity:  " . $kph. " kph\n";
        echo "    Date/Time: " . $time . "\n";*/


        return $this->render('home/live.html.twig',['latLon' => $latLonArray]);
    }

    /**
     * Route that return the passes of the ISS in a PDF file.
     * @Route("/pdf", name="pdf")
     * @throws \Mpdf\MpdfException
     * @throws \App\Predict\PredictException
     */
    public function pdf(){
        //Rechercher la latitude et longitude
        $coord = $this->locationService->getLatLonCity();
        $lat = $coord['lat'];
        $lon = $coord['lon'];
        $cityName = $coord['cityName'];

        $info = [
            'lat' => $lat,
            'lon' => $lon,
            'city' => $cityName
        ];




        if (!is_null($lat) && !is_null($lon)){
            $res = $this->sattelliteCalculation->getVisiblePasses(floatval($lat), floatval($lon));
            $passes = $res['passes'];
        }
        else{
            //TODO ADD FLASHES
            return $this->redirectToRoute('home');
        }

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->render('home/pdf.html.twig',[
            'info' => $info,
            'passes' => $passes
        ]));
        $mpdf->Output('seeiss-'.$info['city'], 'I');



    }

    /**
     * Route that return the privacy page.
     * @Route("/privacy", name="privacy")
     */
    public function privacy(): Response
    {
        return $this->render('home/privacy.html.twig');
    }
}
