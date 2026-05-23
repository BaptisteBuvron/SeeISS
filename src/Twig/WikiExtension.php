<?php

namespace App\Twig;

use App\Entity\Agency;
use App\Entity\Astronaut;
use App\Entity\Launch;
use App\Entity\SpaceStation;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class WikiExtension extends AbstractExtension
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_wiki_spacestations', [$this, 'getSpaceStations']),
            new TwigFunction('get_wiki_agencies', [$this, 'getAgencies']),
            new TwigFunction('get_wiki_astronauts', [$this, 'getAstronauts']),
            new TwigFunction('get_wiki_launches', [$this, 'getLaunches']),
        ];
    }

    public function getSpaceStations(): array
    {
        return $this->entityManager->getRepository(SpaceStation::class)->findBy([], ['name' => 'ASC']);
    }

    public function getAgencies(): array
    {
        return $this->entityManager->getRepository(Agency::class)->findBy([], ['name' => 'ASC']);
    }

    public function getAstronauts(): array
    {
        return $this->entityManager->getRepository(Astronaut::class)->findBy([], ['name' => 'ASC']);
    }

    public function getLaunches(): array
    {
        return $this->entityManager->getRepository(Launch::class)->findBy([], ['windowStart' => 'DESC']);
    }
}
