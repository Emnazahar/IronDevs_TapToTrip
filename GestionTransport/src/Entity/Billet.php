<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BilletRepository::class)
 */
class Billet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="billets")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Vol::class, inversedBy="billet")
     */
    private $vol;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateres(): ?\DateTimeInterface
    {
        return $this->dateres;
    }

    public function setDateres(\DateTimeInterface $dateres): self
    {
        $this->dateres = $dateres;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVol(): ?Vol
    {
        return $this->vol;
    }

    public function setVol(?Vol $vol): self
    {
        $this->vol = $vol;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
