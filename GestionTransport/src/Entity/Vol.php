<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $heurearrive;

    /**
     * @ORM\OneToMany(targetEntity=Billet::class, mappedBy="vol")
     */
    private $billets;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datearrive;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeurearrive(): ?string
    {
        return $this->heurearrive;
    }

    public function setHeurearrive(string $heurearrive): self
    {
        $this->heurearrive = $heurearrive;

        return $this;
    }

    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillets(Billet $billets): self
    {
        if (!$this->billets->contains($billets)) {
            $this->billets[] = $billets;
            $billets->setVol($this);
        }

        return $this;
    }

    public function removeBillets(Billet $billets): self
    {
        if ($this->billets->removeElement($billets)) {
            // set the owning side to null (unless already changed)
            if ($billets->getVol() === $this) {
                $billets->setVol(null);
            }
        }

        return $this;
    }

    public function getDatearrive(): ?\DateTimeInterface
    {
        return $this->datearrive;
    }

    public function setDatearrive(\DateTimeInterface $datearrive): self
    {
        $this->datearrive = $datearrive;

        return $this;
    }
}
