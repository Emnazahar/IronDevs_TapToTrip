<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 *
 */
class User implements UserInterface
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
    private $state;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message="l adresse  n est pas valide")
     * @Assert\NotBlank(message="Email is required")
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Name is required")
     */
    private $Nom;

    /**
     *  @ORM\Column(type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="Last Name is required")
     * )
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=8, nullable=false)
     * @Assert\NotBlank(message="Num° is required")
     * @Assert\Length(
     * min = 8,
     * minMessage = "Votre Num° doit contenir au moins {{limit }} caracteres")
     */
    private $Numtel;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank(message="Password is required")
     * @Assert\Length(min="8", minMessage="Password must be more then 8 caracteres")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Please type the same password" )
     */
    private $password;

    /**
     * @var string The hashed password
     * @Assert\NotBlank
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Length(min="8", minMessage="
     * must be more then 8 caracteres")
     * @Assert\EqualTo(propertyPath="password", message="Please type the same password" )
     */
    public $confirm_password;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reset_token;

    /**
     * @ORM\OneToMany(targetEntity=Billet::class, mappedBy="user")
     */

    private $billets;

    /**
     * @ORM\ManyToMany(targetEntity=Transport::class, mappedBy="users")
     */
    private $transportsfavoris;

    public function __construct()
    {
        $this->transportsfavoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getState(): ?int
    {
        return $this->state;
    }


    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = "ROLE_USER";
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }
    /**
     * @return Collection<int, Transport>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setUser($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getUser() === $this) {
                $transport->setUser(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(Billet $billet): self
    {
        if (!$this->billets->contains($billet)) {
            $this->billets[] = $billet;
            $billet->setUser($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getUser() === $this) {
                $billet->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transport>
     */
    public function getTransportsfavoris(): Collection
    {
        return $this->transportsfavoris;
    }

    public function addTransportsfavori(Transport $transportsfavori): self
    {
        if (!$this->transportsfavoris->contains($transportsfavori)) {
            $this->transportsfavoris[] = $transportsfavori;
            $transportsfavori->addUser($this);
        }

        return $this;
    }

    public function removeTransportsfavori(Transport $transportsfavori): self
    {
        if ($this->transportsfavoris->removeElement($transportsfavori)) {
            $transportsfavori->removeUser($this);
        }

        return $this;
    }


}
