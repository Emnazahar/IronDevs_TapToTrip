<?php

namespace App\Entity;

use App\Repository\CompteBancaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteBancaireRepository::class)
 */
class CompteBancaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $solde;

    /**
     * @ORM\Column(type="integer")
     */
    private $numcarte;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=700)
     */
    private $stripe_public_key;

    /**
     * @ORM\Column(type="string", length=700)
     */
    private $stripe_secret_key;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getNumcarte(): ?int
    {
        return $this->numcarte;
    }

    public function setNumcarte(int $numcarte): self
    {
        $this->numcarte = $numcarte;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStripePublicKey(): ?string
    {
        return $this->stripe_public_key;
    }

    public function setStripePublicKey(string $stripe_public_key): self
    {
        $this->stripe_public_key = $stripe_public_key;

        return $this;
    }

    public function getStripeSecretKey(): ?string
    {
        return $this->stripe_secret_key;
    }

    public function setStripeSecretKey(string $stripe_secret_key): self
    {
        $this->stripe_secret_key = $stripe_secret_key;

        return $this;
    }
}
