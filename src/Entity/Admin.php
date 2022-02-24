<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $NSC;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="champs vide")
     */
    public $Nom;

    /**
     *  @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="champs vide")
     * allowEmptyString = false
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="champs vide")
     */
    private $Numtel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="champs vide")
     */
    private $Email;



    public function getNSC(): ?string
    {
        return $this->NSC;
    }



    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }


    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom($Prenom): self
    {
        $this->Prenom = $Prenom;
        return $this;
    }



    public function getNumtel(): ?string
    {
        return $this->Numtel;
    }

    public function setNumtel(string $Numtel): self
    {
        $this->Numtel = $Numtel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }
}
