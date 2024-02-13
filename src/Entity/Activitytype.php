<?php

namespace App\Entity;

use App\Repository\ActivitytypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(repositoryClass: ActivitytypeRepository::class)]
#[Entity(repositoryClass: EntityRepository::class)]
#[Table(name: 'entity')]
class Activitytype
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'activitytype', targetEntity: Image::class,  cascade:["persist"], orphanRemoval: true)]
    private Collection $imgactivity;

    #[ORM\OneToMany(mappedBy: 'activitytype', targetEntity: Trader::class)]
    private Collection $traders;
    public function __construct()
    {
        $this->imgactivity = new ArrayCollection();
        $this->traders = new ArrayCollection();
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

    /**
     * @return Collection<int, Image>
     */
    public function getImgactivity(): Collection
    {
        return $this->imgactivity;
    }

    public function addImgactivity(Image $imgactivity): static
    {
        if (!$this->imgactivity->contains($imgactivity)) {
            $this->imgactivity->add($imgactivity);
            $imgactivity->setActivitytype($this);
        }

        return $this;
    }

    public function removeImgactivity(Image $imgactivity): static
    {
        if ($this->imgactivity->removeElement($imgactivity)) {
            // set the owning side to null (unless already changed)
            if ($imgactivity->getActivitytype() === $this) {
                $imgactivity->setActivitytype(null);
            }
        }
    }

    /**
     * @return Collection<int, Trader>
     */
    public function getTraders(): Collection
    {
        return $this->traders;
    }

    public function addTrader(Trader $trader): static
    {
        if (!$this->traders->contains($trader)) {
            $this->traders->add($trader);
            $trader->setActivitytype($this);
        }

        return $this;
    }

    public function removeTrader(Trader $trader): static
    {
        if ($this->traders->removeElement($trader)) {
            // set the owning side to null (unless already changed)
            if ($trader->getActivitytype() === $this) {
                $trader->setActivitytype(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title ?? '';
    }



}
