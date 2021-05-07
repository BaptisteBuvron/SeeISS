<?php

namespace App\Entity;

use App\Repository\AgencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgencyRepository::class)
 */
class Agency
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $countryCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abbrev;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $administrator;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $foundingYear;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $infoUrl;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $wikiUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logoUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationUrl;

    /**
     * @ORM\OneToMany(targetEntity=Astronaut::class, mappedBy="agency")
     */
    private $astronauts;

    /**
     * @ORM\OneToMany(targetEntity=SpaceCraftConfig::class, mappedBy="agency")
     */
    private $spaceCraftConfigs;

    /**
     * @ORM\OneToMany(targetEntity=Launch::class, mappedBy="launchServiceProvider")
     */
    private $launches;

    /**
     * @ORM\OneToMany(targetEntity=Launcher::class, mappedBy="manufacturer")
     */
    private $launchers;

    public function __construct()
    {
        $this->astronauts = new ArrayCollection();
        $this->spaceCraftConfigs = new ArrayCollection();
        $this->launches = new ArrayCollection();
        $this->launchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getAbbrev(): ?string
    {
        return $this->abbrev;
    }

    public function setAbbrev(string $abbrev): self
    {
        $this->abbrev = $abbrev;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdministrator(): ?string
    {
        return $this->administrator;
    }

    public function setAdministrator(?string $administrator): self
    {
        $this->administrator = $administrator;

        return $this;
    }

    public function getFoundingYear(): ?string
    {
        return $this->foundingYear;
    }

    public function setFoundingYear(?string $foundingYear): self
    {
        $this->foundingYear = $foundingYear;

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

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;

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

    public function getNationUrl(): ?string
    {
        return $this->nationUrl;
    }

    public function setNationUrl(?string $nationUrl): self
    {
        $this->nationUrl = $nationUrl;

        return $this;
    }

    /**
     * @return Collection|Astronaut[]
     */
    public function getAstronauts(): Collection
    {
        return $this->astronauts;
    }

    public function addAstronaut(Astronaut $astronaut): self
    {
        if (!$this->astronauts->contains($astronaut)) {
            $this->astronauts[] = $astronaut;
            $astronaut->setAgency($this);
        }

        return $this;
    }

    public function removeAstronaut(Astronaut $astronaut): self
    {
        if ($this->astronauts->removeElement($astronaut)) {
            // set the owning side to null (unless already changed)
            if ($astronaut->getAgency() === $this) {
                $astronaut->setAgency(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SpaceCraftConfig[]
     */
    public function getSpaceCraftConfigs(): Collection
    {
        return $this->spaceCraftConfigs;
    }

    public function addSpaceCraftConfig(SpaceCraftConfig $spaceCraftConfig): self
    {
        if (!$this->spaceCraftConfigs->contains($spaceCraftConfig)) {
            $this->spaceCraftConfigs[] = $spaceCraftConfig;
            $spaceCraftConfig->setAgency($this);
        }

        return $this;
    }

    public function removeSpaceCraftConfig(SpaceCraftConfig $spaceCraftConfig): self
    {
        if ($this->spaceCraftConfigs->removeElement($spaceCraftConfig)) {
            // set the owning side to null (unless already changed)
            if ($spaceCraftConfig->getAgency() === $this) {
                $spaceCraftConfig->setAgency(null);
            }
        }

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
            $launch->setLaunchServiceProvider($this);
        }

        return $this;
    }

    public function removeLaunch(Launch $launch): self
    {
        if ($this->launches->removeElement($launch)) {
            // set the owning side to null (unless already changed)
            if ($launch->getLaunchServiceProvider() === $this) {
                $launch->setLaunchServiceProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Launcher[]
     */
    public function getLaunchers(): Collection
    {
        return $this->launchers;
    }

    public function addLauncher(Launcher $launcher): self
    {
        if (!$this->launchers->contains($launcher)) {
            $this->launchers[] = $launcher;
            $launcher->setManufacturer($this);
        }

        return $this;
    }

    public function removeLauncher(Launcher $launcher): self
    {
        if ($this->launchers->removeElement($launcher)) {
            // set the owning side to null (unless already changed)
            if ($launcher->getManufacturer() === $this) {
                $launcher->setManufacturer(null);
            }
        }

        return $this;
    }
}
