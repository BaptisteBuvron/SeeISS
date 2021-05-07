<?php

namespace App\Entity;

use App\Repository\SpaceCraftConfigRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceCraftConfigRepository::class)
 */
class SpaceCraftConfig
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
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Agency::class, inversedBy="spaceCraftConfigs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agency;

    /**
     * @ORM\Column(type="text")
     */
    private $capability;

    /**
     * @ORM\Column(type="text")
     */
    private $history;

    /**
     * @ORM\Column(type="text")
     */
    private $details;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $crewCapacity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $palLoadCapacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wikiLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoLink;

    /**
     * @ORM\OneToMany(targetEntity=SpaceCraft::class, mappedBy="spaceCraftConfig")
     */
    private $spaceCrafts;

    public function __construct()
    {
        $this->spaceCrafts = new ArrayCollection();
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

    public function getAgency(): ?Agency
    {
        return $this->agency;
    }

    public function setAgency(?Agency $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    public function getCapability(): ?string
    {
        return $this->capability;
    }

    public function setCapability(string $capability): self
    {
        $this->capability = $capability;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

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

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getCrewCapacity(): ?int
    {
        return $this->crewCapacity;
    }

    public function setCrewCapacity(?int $crewCapacity): self
    {
        $this->crewCapacity = $crewCapacity;

        return $this;
    }

    public function getPalLoadCapacity(): ?int
    {
        return $this->palLoadCapacity;
    }

    public function setPalLoadCapacity(?int $palLoadCapacity): self
    {
        $this->palLoadCapacity = $palLoadCapacity;

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

    public function getWikiLink(): ?string
    {
        return $this->wikiLink;
    }

    public function setWikiLink(?string $wikiLink): self
    {
        $this->wikiLink = $wikiLink;

        return $this;
    }

    public function getInfoLink(): ?string
    {
        return $this->infoLink;
    }

    public function setInfoLink(?string $infoLink): self
    {
        $this->infoLink = $infoLink;

        return $this;
    }

    /**
     * @return Collection|SpaceCraft[]
     */
    public function getSpaceCrafts(): Collection
    {
        return $this->spaceCrafts;
    }

    public function addSpaceCraft(SpaceCraft $spaceCraft): self
    {
        if (!$this->spaceCrafts->contains($spaceCraft)) {
            $this->spaceCrafts[] = $spaceCraft;
            $spaceCraft->setSpaceCraftConfig($this);
        }

        return $this;
    }

    public function removeSpaceCraft(SpaceCraft $spaceCraft): self
    {
        if ($this->spaceCrafts->removeElement($spaceCraft)) {
            // set the owning side to null (unless already changed)
            if ($spaceCraft->getSpaceCraftConfig() === $this) {
                $spaceCraft->setSpaceCraftConfig(null);
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
}
