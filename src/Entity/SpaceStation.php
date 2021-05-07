<?php

namespace App\Entity;

use App\Repository\SpaceStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceStationRepository::class)
 */
class SpaceStation
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $founded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mass;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $volume;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orbit;

    /**
     * @ORM\Column(type="integer")
     */
    private $onboardCrew;

    /**
     * @ORM\ManyToMany(targetEntity=Agency::class)
     */
    private $owners;

    /**
     * @ORM\OneToMany(targetEntity=Astronaut::class, mappedBy="spaceStation")
     */
    private $crew;

    /**
     * @ORM\OneToMany(targetEntity=Docking::class, mappedBy="spaceStation")
     */
    private $dockingLocation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
        $this->crew = new ArrayCollection();
        $this->dockingLocation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdApi(): ?int
    {
        return $this->idApi;
    }

    /**
     * @param mixed $idApi
     */
    public function setIdApi(int $idApi): self
    {
        $this->idApi = $idApi;
        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFounded(): ?\DateTimeInterface
    {
        return $this->founded;
    }

    public function setFounded(\DateTimeInterface $founded): self
    {
        $this->founded = $founded;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getMass(): ?int
    {
        return $this->mass;
    }

    public function setMass(?int $mass): self
    {
        $this->mass = $mass;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrbit(): ?string
    {
        return $this->orbit;
    }

    public function setOrbit(string $orbit): self
    {
        $this->orbit = $orbit;

        return $this;
    }

    public function getOnboardCrew(): ?int
    {
        return $this->onboardCrew;
    }

    public function setOnboardCrew(int $onboardCrew): self
    {
        $this->onboardCrew = $onboardCrew;

        return $this;
    }

    /**
     * @return Collection|Agency[]
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(Agency $owner): self
    {
        if (!$this->owners->contains($owner)) {
            $this->owners[] = $owner;
        }

        return $this;
    }

    public function removeOwner(Agency $owner): self
    {
        $this->owners->removeElement($owner);

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getCrew(): Collection
    {
        return $this->crew;
    }

    public function addCrew(Astronaut $crew): self
    {
        if (!$this->crew->contains($crew)) {
            $this->crew[] = $crew;
            $crew->setSpaceStation($this);
        }

        return $this;
    }

    public function removeCrew(Astronaut $crew): self
    {
        if ($this->crew->removeElement($crew)) {
            // set the owning side to null (unless already changed)
            if ($crew->getSpaceStation() === $this) {
                $crew->setSpaceStation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Docking[]
     */
    public function getDockingLocation(): Collection
    {
        return $this->dockingLocation;
    }

    public function addDockingLocation(Docking $dockingLocation): self
    {
        if (!$this->dockingLocation->contains($dockingLocation)) {
            $this->dockingLocation[] = $dockingLocation;
            $dockingLocation->setSpaceStation($this);
        }

        return $this;
    }

    public function removeDockingLocation(Docking $dockingLocation): self
    {
        if ($this->dockingLocation->removeElement($dockingLocation)) {
            // set the owning side to null (unless already changed)
            if ($dockingLocation->getSpaceStation() === $this) {
                $dockingLocation->setSpaceStation(null);
            }
        }

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
