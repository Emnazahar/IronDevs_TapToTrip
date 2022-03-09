<?php

namespace App\Entity;

use App\Repository\AttractionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AttractionRepository::class)
 */
class Attraction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit etre supérieur à {{ limit }} caratéres",
     *      maxMessage = "Le nom doit etre inférieure à {{ limit }} caractéres"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit etre supérieur à {{ limit }} caratéres",
     *      maxMessage = "Le nom doit etre inférieure à {{ limit }} caractéres"
     * )
     */
    private $lieu;

    /**
     * @ORM\Column(type="text", length=500)
     * @Assert\NotBlank
     */
    private $description;


    /**
     * @ORM\OneToMany(targetEntity=VoyageOrganise::class, mappedBy="attraction" ,cascade={"remove"})
     */
    private $voyageOrganises;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="attractions", orphanRemoval=true, cascade={"persist"})
     * @Assert\NotBlank
     */
    private $images;



    public function __construct()
    {
        $this->voyageOrganises = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }



    //Récuperer par Nom
    public function __toString()
    {
        return(string)$this->getNom();
    }

    /**
     * @return Collection|VoyageOrganise[]
     */
    public function getVoyageOrganises(): Collection
    {
        return $this->voyageOrganises;
    }

    public function addVoyageOrganise(VoyageOrganise $voyageOrganise): self
    {
        if (!$this->voyageOrganises->contains($voyageOrganise)) {
            $this->voyageOrganises[] = $voyageOrganise;
            $voyageOrganise->setAttraction($this);
        }

        return $this;
    }

    public function removeVoyageOrganise(VoyageOrganise $voyageOrganise): self
    {
        if ($this->voyageOrganises->removeElement($voyageOrganise)) {
            // set the owning side to null (unless already changed)
            if ($voyageOrganise->getAttraction() === $this) {
                $voyageOrganise->setAttraction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAttractions($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAttractions() === $this) {
                $image->setAttractions(null);
            }
        }

        return $this;
    }




}
