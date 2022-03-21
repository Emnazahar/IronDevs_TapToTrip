<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $Num;

    /**
     * @ORM\Column(type="date", length=255)
     * @Assert\NotBlank
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=20)
     */
    private $Destination;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $Categorie;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\ManyToOne(targetEntity=Vol::class, inversedBy="billets")
     */
    private $volBillet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="billets")
     */
    private $user;
    public function getId(): ?int
    {
        return $this->id;
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
    public function getNum(): ?int
    {
        return $this->Num;
    }

    public function setNum(int $Num): self
    {
        $this->Num = $Num;

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

    public function getDestination(): ?string
    {
        return $this->Destination;
    }

    public function setDestination(string $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getVolBillet(): ?Vol
    {
        return $this->volBillet;
    }

    public function setVolBillet(?Vol $volBillet): self
    {
        $this->volBillet = $volBillet;

        return $this;
    }


}
