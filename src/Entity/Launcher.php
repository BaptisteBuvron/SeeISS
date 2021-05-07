<?php

namespace App\Entity;

use App\Repository\LauncherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LauncherRepository::class)
 */
class Launcher
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\ManyToOne(targetEntity=Agency::class, inversedBy="launchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minStage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxStage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wikiUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalLaunchCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $consecutiveSuccessfulLaunches;

    /**
     * @ORM\Column(type="integer")
     */
    private $failedLaunch;

    /**
     * @ORM\OneToMany(targetEntity=Launch::class, mappedBy="launcher")
     */
    private $launches;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $successfulLaunches;

    public function __construct()
    {
        $this->launches = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getManufacturer(): ?Agency
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Agency $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getMinStage(): ?int
    {
        return $this->minStage;
    }

    public function setMinStage(?int $minStage): self
    {
        $this->minStage = $minStage;

        return $this;
    }

    public function getMaxStage(): ?int
    {
        return $this->maxStage;
    }

    public function setMaxStage(?int $maxStage): self
    {
        $this->maxStage = $maxStage;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

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

    public function getInfoUrl(): ?string
    {
        return $this->infoUrl;
    }

    public function setInfoUrl(?string $infoUrl): self
    {
        $this->infoUrl = $infoUrl;

        return $this;
    }

    public function getWikiUrl(): ?string
    {
        return $this->wikiUrl;
    }

    public function setWikiUrl(?string $wikiUrl): self
    {
        $this->wikiUrl = $wikiUrl;

        return $this;
    }

    public function getTotalLaunchCount(): ?int
    {
        return $this->totalLaunchCount;
    }

    public function setTotalLaunchCount(int $totalLaunchCount): self
    {
        $this->totalLaunchCount = $totalLaunchCount;

        return $this;
    }

    public function getConsecutiveSuccessfulLaunches(): ?int
    {
        return $this->consecutiveSuccessfulLaunches;
    }

    public function setConsecutiveSuccessfulLaunches(int $consecutiveSuccessfulLaunches): self
    {
        $this->consecutiveSuccessfulLaunches = $consecutiveSuccessfulLaunches;

        return $this;
    }

    public function getFailedLaunch(): ?int
    {
        return $this->failedLaunch;
    }

    public function setFailedLaunch(int $failedLaunch): self
    {
        $this->failedLaunch = $failedLaunch;

        return $this;
    }

    /**
     * @return Collection|Launch[]
     */
    public function getLaunches(): Collection
    {
        return $this->launches;
    }

    public function addLaunch(Launch $launch): self
    {
        if (!$this->launches->contains($launch)) {
            $this->launches[] = $launch;
            $launch->setLauncher($this);
        }

        return $this;
    }

    public function removeLaunch(Launch $launch): self
    {
        if ($this->launches->removeElement($launch)) {
            // set the owning side to null (unless already changed)
            if ($launch->getLauncher() === $this) {
                $launch->setLauncher(null);
            }
        }

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

    public function getSuccessfulLaunches(): ?string
    {
        return $this->successfulLaunches;
    }

    public function setSuccessfulLaunches(string $successfulLaunches): self
    {
        $this->successfulLaunches = $successfulLaunches;

        return $this;
    }
}
