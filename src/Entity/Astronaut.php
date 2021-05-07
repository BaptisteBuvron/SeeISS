<?php

namespace App\Entity;

use App\Repository\AstronautRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AstronautRepository::class)
 */
class Astronaut
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
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Agency::class, inversedBy="astronauts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $agency;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfDeath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="text")
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profileImg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profileImageThumbnail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wiki;

    /**
     * @ORM\ManyToOne(targetEntity=SpaceStation::class, inversedBy="crew")
     */
    private $spaceStation;

    /**
     * @ORM\ManyToMany(targetEntity=Launch::class, mappedBy="launchCrew")
     */
    private $launches;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getDateOfDeath(): ?\DateTimeInterface
    {
        return $this->dateOfDeath;
    }

    public function setDateOfDeath(?\DateTimeInterface $dateOfDeath): self
    {
        $this->dateOfDeath = $dateOfDeath;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getProfileImg(): ?string
    {
        return $this->profileImg;
    }

    public function setProfileImg(?string $profileImg): self
    {
        $this->profileImg = $profileImg;

        return $this;
    }

    public function getProfileImageThumbnail(): ?string
    {
        return $this->profileImageThumbnail;
    }

    public function setProfileImageThumbnail(?string $profileImageThumbnail): self
    {
        $this->profileImageThumbnail = $profileImageThumbnail;

        return $this;
    }

    public function getWiki(): ?string
    {
        return $this->wiki;
    }

    public function setWiki(?string $wiki): self
    {
        $this->wiki = $wiki;

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
            $launch->addLaunchCrew($this);
        }

        return $this;
    }

    public function removeLaunch(Launch $launch): self
    {
        if ($this->launches->removeElement($launch)) {
            $launch->removeLaunchCrew($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdApi()
    {
        return $this->idApi;
    }

    /**
     * @param mixed $idApi
     */
    public function setIdApi($idApi): self
    {
        $this->idApi = $idApi;
        return $this;
    }
}
