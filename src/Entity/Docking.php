<?php

namespace App\Entity;

use App\Repository\DockingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DockingRepository::class)
 */
class Docking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $idApi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime")
     */
    private $docking;

    /**
     * @ORM\OneToOne(targetEntity=SpaceCraft::class, cascade={"persist", "remove"})
     */
    private $spaceCraft;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceStation::class, inversedBy="dockingLocation")
     */
    private $spaceStation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDocking(): ?\DateTimeInterface
    {
        return $this->docking;
    }

    public function setDocking(\DateTimeInterface $docking): self
    {
        $this->docking = $docking;

        return $this;
    }

    public function getSpaceCraft(): ?SpaceCraft
    {
        return $this->spaceCraft;
    }

    public function setSpaceCraft(?SpaceCraft $spaceCraft): self
    {
        $this->spaceCraft = $spaceCraft;

        return $this;
    }

    public function getSpaceStation(): ?SpaceStation
    {
        return $this->spaceStation;
    }

    public function setSpaceStation(?SpaceStation $spaceStation): self
    {
        $this->spaceStation = $spaceStation;

        return $this;
    }

    public function getIdApi()
    {
        return $this->idApi;
    }


    public function setIdApi($idApi): self
    {
        $this->idApi = $idApi;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
