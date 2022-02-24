<?php

namespace App\Entity;

use App\Repository\VoyageOrganiseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VoyageOrganiseRepository::class)
 */
class VoyageOrganise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit etre supérieur à {{ limit }} caratéres",
     *      maxMessage = "Le nom doit etre inférieure à {{ limit }} caractéres"
     * )
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $duree;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File()
     * @Assert\NotBlank
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $hotel;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotNull
     */
    private $prix;



    /**
     * @ORM\ManyToOne(targetEntity=Attraction::class, inversedBy="voyageOrganises")
     * @Assert\NotBlank
     */
    private $attraction;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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


    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getHotel(): ?string
    {
        return $this->hotel;
    }

    public function setHotel(string $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }



    public function getAttraction(): ?Attraction
    {
        return $this->attraction;
    }

    public function setAttraction(?Attraction $attraction): self
    {
        $this->attraction = $attraction;

        return $this;
    }







}
