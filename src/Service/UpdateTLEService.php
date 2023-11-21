<?php


namespace App\Service;


use App\Entity\TwoLineElement;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class UpdateTLEService
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateIssTleFile() : TwoLineElement{
        $url = 'http://celestrak.com/NORAD/elements/stations.txt';
        $contents = file_get_contents($url) or die('Could not updated tle get file');
        $contents = explode("\n", $contents);
        $name = trim($contents[0]);
        $line1 = trim($contents[1]);
        $line2 = trim($contents[2]);

        $TwoLineElementRepository = $this->entityManager->getRepository(TwoLineElement::class);
        $ISSTwoLine = $TwoLineElementRepository->findOneBy(['title' => $name]);
        if (!$ISSTwoLine) {
            $ISSTwoLine = new TwoLineElement();
        }
        $ISSTwoLine->setTitle($name);
        $ISSTwoLine->setLine1($line1);
        $ISSTwoLine->setLine2($line2);

        $this->entityManager->persist($ISSTwoLine);
        $this->entityManager->flush();
        return $ISSTwoLine;
    }

}