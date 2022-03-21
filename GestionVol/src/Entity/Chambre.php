<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
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
    private $nbrlits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeCh;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Hotel::class, mappedBy="chambre")
     */
    private $chambres;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrlits(): ?int
    {
        return $this->nbrlits;
    }

    public function setNbrlits(int $nbrlits): self
    {
        $this->nbrlits = $nbrlits;

        return $this;
    }

    public function getTypeCh(): ?string
    {
        return $this->typeCh;
    }

    public function setTypeCh(string $typeCh): self
    {
        $this->typeCh = $typeCh;

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

    /**
     * @return Collection<int, Hotel>
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Hotel $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setChambre($this);
        }

        return $this;
    }

    public function removeChambre(Hotel $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getChambre() === $this) {
                $chambre->setChambre(null);
            }
        }

        return $this;
    }





}
