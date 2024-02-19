<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $weightprice = null;

    #[ORM\Column]
    private ?float $unitprice = null;

    #[ORM\Column]
    private ?float $weightproduct = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $composition = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Categoryproduct $categoryproduct = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Image::class)]
    private Collection $photo;

    
    public function __construct()
    {
        $this->photo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getWeightprice(): ?float
    {
        return $this->weightprice;
    }

    public function setWeightprice(float $weightprice): static
    {
        $this->weightprice = $weightprice;

        return $this;
    }

    public function getUnitprice(): ?float
    {
        return $this->unitprice;
    }

    public function setUnitprice(float $unitprice): static
    {
        $this->unitprice = $unitprice;

        return $this;
    }

    public function getWeightproduct(): ?float
    {
        return $this->weightproduct;
    }

    public function setWeightproduct(float $weightproduct): static
    {
        $this->weightproduct = $weightproduct;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(?string $composition): static
    {
        $this->composition = $composition;

        return $this;
    }

    public function getCategoryproduct(): ?Categoryproduct
    {
        return $this->categoryproduct;
    }

    public function setCategoryproduct(?Categoryproduct $categoryproduct): static
    {
        $this->categoryproduct = $categoryproduct;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Image $photo): static
    {
        if (!$this->photo->contains($photo)) {
            $this->photo->add($photo);
            $photo->setProduct($this);
        }

        return $this;
    }

    public function removePhoto(Image $photo): static
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getProduct() === $this) {
                $photo->setProduct(null);
            }
        }

        return $this;
    }

}
