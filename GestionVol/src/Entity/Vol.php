<?php

namespace App\Entity;

use App\Repository\VolRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VolRepository::class)
 */
class Vol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $NumVol;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $HeureDep;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $HeureArrive;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Origine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumVol(): ?int
    {
        return $this->NumVol;
    }

    public function setNumVol(int $NumVol): self
    {
        $this->NumVol = $NumVol;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getHeureDep(): ?string
    {
        return $this->HeureDep;
    }

    public function setHeureDep(string $HeureDep): self
    {
        $this->HeureDep = $HeureDep;

        return $this;
    }

    public function getHeureArrive(): ?string
    {
        return $this->HeureArrive;
    }

    public function setHeureArrive(string $HeureArrive): self
    {
        $this->HeureArrive = $HeureArrive;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->Origine;
    }

    public function setOrigine(string $Origine): self
    {
        $this->Origine = $Origine;

        return $this;
    }
}
