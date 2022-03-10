<?php

namespace App\Entity;

use App\Repository\UserRepository;
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
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message="l adresse  n est pas valide")
     * @Assert\NotBlank(message="Email is required")
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Name is required")
     * @Assert\Type(
     * type={"alpha", "digit"},
     * message="Votre nom {{ value }} doit contenir
    seulement des lettres alphabétiques"
     * )
     */
    private $Nom;

    /**
     *  @ORM\Column(type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="Last Name is required")
     *  @Assert\Type(
     * type={"alpha", "digit"},
     * message="Votre prenom {{ value }} doit contenir
    seulement des lettres alphabétiques"
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
     * @Assert\Length(min="8", minMessage="Password must be more then 8 caracteres")
     * @Assert\EqualTo(propertyPath="password", message="Please type the same password" )
     */
    public $confirm_password;


    public function getId(): ?int
    {
        return $this->id;
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
        // guarantee every user at least has ROLE_USER
        $roles[] = "ROLE_ADMIN";
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
}
