<?php

namespace App\Entity;

use App\Repository\LaunchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaunchRepository::class)
 */
class Launch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $idApi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $windowEnd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $windowStart;

    /**
     * @ORM\ManyToOne(targetEntity=Agency::class, inversedBy="launches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $launchServiceProvider;

    /**
     * @ORM\OneToOne(targetEntity=SpaceCraft::class, inversedBy="launch", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $spaceCraft;

    /**
     * @ORM\ManyToMany(targetEntity=Astronaut::class, inversedBy="launches")
     */
    private $launchCrew;

    /**
     * @ORM\ManyToOne(targetEntity=Video::class)
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity=Launcher::class, inversedBy="launches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $launcher;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infographic;

    public function __construct()
    {
        $this->launchCrew = new ArrayCollection();
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getWindowEnd(): ?\DateTimeInterface
    {
        return $this->windowEnd;
    }

    public function setWindowEnd(?\DateTimeInterface $windowEnd): self
    {
        $this->windowEnd = $windowEnd;

        return $this;
    }

    public function getWindowStart(): ?\DateTimeInterface
    {
        return $this->windowStart;
    }

    public function setWindowStart(?\DateTimeInterface $windowStart): self
    {
        $this->windowStart = $windowStart;

        return $this;
    }

    public function getLaunchServiceProvider(): ?Agency
    {
        return $this->launchServiceProvider;
    }

    public function setLaunchServiceProvider(?Agency $launchServiceProvider): self
    {
        $this->launchServiceProvider = $launchServiceProvider;

        return $this;
    }

    public function getSpaceCraft(): ?spaceCraft
    {
        return $this->spaceCraft;
    }

    public function setSpaceCraft(spaceCraft $spaceCraft): self
    {
        $this->spaceCraft = $spaceCraft;

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getLaunchCrew(): Collection
    {
        return $this->launchCrew;
    }

    public function addLaunchCrew(Astronaut $launchCrew): self
    {
        if (!$this->launchCrew->contains($launchCrew)) {
            $this->launchCrew[] = $launchCrew;
        }

        return $this;
    }

    public function removeLaunchCrew(Astronaut $launchCrew): self
    {
        $this->launchCrew->removeElement($launchCrew);

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getLauncher(): ?Launcher
    {
        return $this->launcher;
    }

    public function setLauncher(?Launcher $launcher): self
    {
        $this->launcher = $launcher;

        return $this;
    }

    public function getIdApi(): string
    {
        return $this->idApi;
    }


    public function setIdApi(string $idApi): self
    {
        $this->idApi = $idApi;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getInfographic(): ?string
    {
        return $this->infographic;
    }

    public function setInfographic(?string $infographic): self
    {
        $this->infographic = $infographic;

        return $this;
    }
}
