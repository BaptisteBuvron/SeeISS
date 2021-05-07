<?php

namespace App\Entity;

use App\Repository\SpaceCraftRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpaceCraftRepository::class)
 */
class SpaceCraft
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceCraftConfig::class, inversedBy="spaceCrafts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spaceCraftConfig;

    /**
     * @ORM\OneToOne(targetEntity=Launch::class, mappedBy="spaceCraft", cascade={"persist", "remove"})
     */
    private $launch;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function getSpaceCraftConfig(): ?SpaceCraftConfig
    {
        return $this->spaceCraftConfig;
    }

    public function setSpaceCraftConfig(?SpaceCraftConfig $spaceCraftConfig): self
    {
        $this->spaceCraftConfig = $spaceCraftConfig;

        return $this;
    }

    public function getLaunch(): ?Launch
    {
        return $this->launch;
    }

    public function setLaunch(Launch $launch): self
    {
        // set the owning side of the relation if necessary
        if ($launch->getSpaceCraft() !== $this) {
            $launch->setSpaceCraft($this);
        }

        $this->launch = $launch;

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
