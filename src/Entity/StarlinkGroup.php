<?php

namespace App\Entity;

use App\Repository\StarlinkGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StarlinkGroupRepository::class)
 */
class StarlinkGroup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearLaunch;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberLaunch;


    /**
     * @ORM\OneToMany(targetEntity=Starlink::class, mappedBy="starlinkGroup")
     */
    private $starkinks;

    public function __construct()
    {
        $this->starkinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }





    /**
     * @return Collection|Starlink[]
     */
    public function getStarkinks(): Collection
    {
        return $this->starkinks;
    }

    public function addStarkink(Starlink $starkink): self
    {
        if (!$this->starkinks->contains($starkink)) {
            $this->starkinks[] = $starkink;
            $starkink->setStarlinkGroup($this);
        }

        return $this;
    }

    public function removeStarkink(Starlink $starkink): self
    {
        if ($this->starkinks->removeElement($starkink)) {
            // set the owning side to null (unless already changed)
            if ($starkink->getStarlinkGroup() === $this) {
                $starkink->setStarlinkGroup(null);
            }
        }

        return $this;
    }

    public function getYearLaunch(): ?int
    {
        return $this->yearLaunch;
    }

    public function setYearLaunch(int $yearLaunch): self
    {
        $this->yearLaunch = $yearLaunch;

        return $this;
    }

    public function getNumberLaunch(): ?int
    {
        return $this->numberLaunch;
    }

    public function setNumberLaunch(int $numberLaunch): self
    {
        $this->numberLaunch = $numberLaunch;

        return $this;
    }

    public function __toString(): string
    {
        return $this->yearLaunch . '-' . $this->numberLaunch . ' ('. $this->getStarkinks()->count() .' satellites)';
    }


}
