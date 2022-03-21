<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @UniqueEntity("nom")
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Veuillez remplir tous les champs")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="Veuillez remplir tous les champs")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $boitevitesse;

    /**
     * @ORM\OneToMany(targetEntity=Transport::class, mappedBy="categorie",cascade={"remove"})
     */
    private $transports;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getBoiteVitesse(): ?string
    {
        return $this->boitevitesse;
    }

    public function setBoiteVitesse(?string $boitevitesse): self
    {
        $this->boitevitesse = $boitevitesse;

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setIdcategorie($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getIdcategorie() === $this) {
                $transport->setIdcategorie(null);
            }
        }
        return $this;
    }
}
