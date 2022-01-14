<?php

namespace App\Controller;

use App\Entity\PasseDisplay;
use App\Entity\StarlinkGroup;
use App\Form\StarlinkGroupType;
use App\Predict\PredictTLE;
use App\Service\GetLocationService;
use App\Service\SattelliteCalculation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StarlinkController extends AbstractController
{

    private GetLocationService $locationService;
    private SattelliteCalculation $sattelliteCalculation;

    public function __construct(GetLocationService $getLocationService, SattelliteCalculation $sattelliteCalculation)
    {
        $this->locationService = $getLocationService;
        $this->sattelliteCalculation = $sattelliteCalculation;
    }



    #[Route('/starlink', name: 'starlink')]
    public function index(SattelliteCalculation $sattelliteCalculation, EntityManagerInterface $manager, Request $request): Response
    {
        $starlinkGroupRepo = $manager->getRepository(StarlinkGroup::class);
        $starlinkGroup = $starlinkGroupRepo->findLast();
        $form = $this->createForm(StarlinkGroupType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $starlinkGroup = $form->get('starlinkGroup')->getData() ?? $starlinkGroup;
            $coord = $this->locationService->getLatLonCity($form);
        }
        else{
            $coord = $this->locationService->getLatLonCity();
        }






        $lat = $coord['lat'];
        $lon = $coord['lon'];
        $cityName = $coord['cityName'];

        $info = [
            'lat' => $lat,
            'lon' => $lon,
            'city' => $cityName
        ];

        $array = array();
        $arrayDate = array();
        $totalPasses = array();

        if ($starlinkGroup) {


            foreach ($starlinkGroup->getStarkinks() as $starlink) {
                $array[] = $sattelliteCalculation->getVisiblePassesStarlink($lat, $lon, $starlink, 5);
            }
            $array = array_merge(...$array);
            usort($array, function (PasseDisplay $a, PasseDisplay $b) {
                return $a->getUTCstart() - $b->getUTCstart();
            });
            $totalPasses = $sattelliteCalculation->getArrayPassesForMap($array);

            //Sort passes by date
            foreach ($array as $pass) {
                $arrayDate[$pass->getDate()][] = $pass;
            }
        }


        return $this->render('starlink/index.html.twig', [
            'passes' => $arrayDate,
            'form' => $form->createView(),
            'info' => $info,
            'totalPasses' => $totalPasses
        ]);
    }
}
