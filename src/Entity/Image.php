<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'imgactivity')]
    private ?Activitytype $activitytype = null;

    
    #[ORM\ManyToOne(inversedBy: 'photo')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'profilephoto')]
    private ?Trader $trader = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function __toString()
    {
        return $this->name ?? '';
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getTrader(): ?Trader
    {
        return $this->trader;
    }

    public function setTrader(?Trader $trader): static
    {
        $this->trader = $trader;

        return $this;
    }


}
