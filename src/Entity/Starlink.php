<?php

namespace App\Entity;

use App\Repository\StarlinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StarlinkRepository::class)
 */
class Starlink extends Satellite
{

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $number;

    /**
     * @ORM\ManyToOne(targetEntity=StarlinkGroup::class, inversedBy="starkinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $starlinkGroup;

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getStarlinkGroup(): ?StarlinkGroup
    {
        return $this->starlinkGroup;
    }

    public function setStarlinkGroup(?StarlinkGroup $starlinkGroup): self
    {
        $this->starlinkGroup = $starlinkGroup;

        return $this;
    }

}
