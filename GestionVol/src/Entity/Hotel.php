<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
     *      minMessage = "Le nom de l'hotel doit etre supérieure a  {{ limit }} characteres",
     *      maxMessage = "Le nom de l'hotel doit etre inférieure a {{ limit }} characteres",
     *      allowEmptyString = false
     * )
     */
    private $nomH;

    /**
     * @ORM\Column(type="integer")
     *   @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      notInRangeMessage = "vous devrez etre entre  {{ min }} etoiles et {{ max }} etoiles pour passer",
     * )
     */
    private $nbEtoiles;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "L'adresse de l'hotel doit etre supérieure a  {{ limit }} characteres",
     *      maxMessage = "L'adresse de l'hotel doit etre inférieure a {{ limit }} characteres",
     *      allowEmptyString = false
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "La description de l'hotel doit etre supérieure a  {{ limit }} characteres",
     *      maxMessage = "La description de  l'hotel doit etre inférieure a {{ limit }} characteres",
     *      allowEmptyString = false
     * )
     */
    private $descriptionH;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="chambres")
     */
    private $chambre;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomH(): ?string
    {
        return $this->nomH;
    }

    public function setNomH(string $nomH): self
    {
        $this->nomH = $nomH;

        return $this;
    }

    public function getNbEtoiles(): ?int
    {
        return $this->nbEtoiles;
    }

    public function setNbEtoiles(int $nbEtoiles): self
    {
        $this->nbEtoiles = $nbEtoiles;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDescriptionH(): ?string
    {
        return $this->descriptionH;
    }

    public function setDescriptionH(string $descriptionH): self
    {
        $this->descriptionH = $descriptionH;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }



}
