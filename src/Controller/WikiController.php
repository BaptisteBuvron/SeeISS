<?php


namespace App\Controller;


use App\Entity\Agency;
use App\Entity\Astronaut;
use App\Entity\Launch;
use App\Entity\SpaceStation;
use Cocur\Slugify\Slugify;
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
     * @Route("/agency/{nameSlug}/{idApi}", name="agency")
     */
    public function agency(Agency $agency, $nameSlug){

        $slugify = new Slugify();
        if ($slugify->slugify($agency->getName()) != $nameSlug){
            return $this->redirectToRoute('agency', ['nameSlug' => $slugify->slugify($agency->getName()), 'idApi' => $agency->getIdApi()]);
        }
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
     * @Route("/astronaut/{nameAstro}/{idApi}", name="astronaut")
     */
    public function astronaut(Astronaut $astronaut, $nameAstro){
        $slugify = new Slugify();
        if ($slugify->slugify($astronaut->getName()) != $nameAstro){
            return $this->redirectToRoute('astronaut', ['nameAstro' => $slugify->slugify($astronaut->getName()), 'idApi' => $astronaut->getIdApi()]);
        }
        return $this->render('wiki/astronaut.html.twig', [
            'astronaut' => $astronaut
        ]);
    }
}