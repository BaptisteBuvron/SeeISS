<?php


namespace App\Controller;


use App\Entity\Agency;
use App\Entity\Astronaut;
use App\Entity\Launch;
use App\Entity\SpaceStation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WikiController extends AbstractController
{
    /**
     * @Route("/spacestation/{idApi}", name="spacestation")
     */
    public function spaceStation(SpaceStation $spaceStation){
        return $this->render('wiki/spacestation.html.twig',[
            'spaceStation' => $spaceStation
        ]);
    }

    /**
     * @param Agency $agency
     * @Route("/agency/{idApi}", name="agency")
     */
    public function agency(Agency $agency){
        return $this->render('wiki/agency.html.twig',[
            'agency' => $agency        ]);
    }


    /**
     * @param Launch $launch
     * @Route("/launch/{slug}/{idApi}", name="launch")
     */
    public function launch(Launch $launch){
        return $this->render('wiki/launch.html.twig', [
            'launch' => $launch
        ]);
    }

    /**
     * @param Astronaut $astronaut
     * @Route("/astronaut/{idApi}", name="astronaut")
     */
    public function astronaut(Astronaut $astronaut){
        return $this->render('wiki/astronaut.html.twig', [
            'astronaut' => $astronaut
        ]);
    }
}