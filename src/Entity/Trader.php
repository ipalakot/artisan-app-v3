<?php

namespace App\Entity;

use App\Repository\TraderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: TraderRepository::class)]
class Trader implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    #[Assert\Length(
        min: 8,
        max: 60,
        minMessage: 'Le mot de passe doit faire au moins {{ limit }} caractères.',
        maxMessage: 'Le mot de passe ne doit pas dépasser {{ limit }} caractères.',
    )]
    #[Assert\EqualTo(propertyPath: "confirmpassword", message: "Les mots de passe ne correspondent pas.")]
    #[Assert\Regex(pattern: "^(?=.*[A-Z])(?=.*[!@#$%^&*()-_=+{};:'\",<.>/?`~])")]
    private ?string $password = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    #[Assert\EqualTo(propertyPath: "password", message: "Les mots de passe ne correspondent pas.")]
    private ?string $confirmpassword = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $lastnameboss = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $firstnameboss = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $compagnyname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $siren = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $adress = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $presentation = null;

    #[ORM\ManyToOne(inversedBy: 'traders')]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?Activitytype $activitytype = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $postalcode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'ce champ est obligatoire!')]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Image::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $profilephoto;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Image::class, cascade: ["persist"], orphanRemoval: true)]
    private Collection $coverphoto;

    #[ORM\OneToMany(mappedBy: 'trader', targetEntity: Product::class)]
    private Collection $products;

    public function __construct()
    {
        $this->profilephoto = new ArrayCollection();
        $this->coverphoto = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
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
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getConfirmpassword(): ?string
    {
        return $this->confirmpassword;
    }

    public function setConfirmpassword(string $confirmpassword): static
    {
        $this->confirmpassword = $confirmpassword;

        return $this;
    }

    public function getLastnameboss(): ?string
    {
        return $this->lastnameboss;
    }

    public function setLastnameboss(string $lastnameboss): static
    {
        $this->lastnameboss = $lastnameboss;

        return $this;
    }

    public function getFirstnameboss(): ?string
    {
        return $this->firstnameboss;
    }

    public function setFirstnameboss(string $firstnameboss): static
    {
        $this->firstnameboss = $firstnameboss;

        return $this;
    }

    public function getCompagnyname(): ?string
    {
        return $this->compagnyname;
    }

    public function setCompagnyname(string $compagnyname): static
    {
        $this->compagnyname = $compagnyname;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): static
    {
        $this->siren = $siren;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getActivitytype(): ?Activitytype
    {
        return $this->activitytype;
    }

    public function setActivitytype(?Activitytype $activitytype): static
    {
        $this->activitytype = $activitytype;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): static
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getProfilephoto(): Collection
    {
        return $this->profilephoto;
    }

    public function addProfilephoto(Image $profilephoto): static
    {
        if (!$this->profilephoto->contains($profilephoto)) {
            $this->profilephoto->add($profilephoto);
            $profilephoto->setTrader($this);
        }

        return $this;
    }

    public function removeProfilephoto(Image $profilephoto): static
    {
        if ($this->profilephoto->removeElement($profilephoto)) {
            // set the owning side to null (unless already changed)
            if ($profilephoto->getTrader() === $this) {
                $profilephoto->setTrader(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getCoverphoto(): Collection
    {
        return $this->coverphoto;
    }

    public function addCoverphoto(Image $coverphoto): static
    {
        if (!$this->coverphoto->contains($coverphoto)) {
            $this->coverphoto->add($coverphoto);
            $coverphoto->setTrader($this);
        }

        return $this;
    }

    public function removeCoverphoto(Image $coverphoto): static
    {
        if ($this->coverphoto->removeElement($coverphoto)) {
            // set the owning side to null (unless already changed)
            if ($coverphoto->getTrader() === $this) {
                $coverphoto->setTrader(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setTrader($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getTrader() === $this) {
                $product->setTrader(null);
            }
        }

        return $this;
    }
}
