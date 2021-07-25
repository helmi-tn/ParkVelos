<?php

namespace App\Entity;

use App\Repository\TailleVeloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TailleVeloRepository::class)
 */
class TailleVelo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="integer")
     */
    private $min;

    /**
     * @ORM\OneToMany(targetEntity=Velo::class, mappedBy="taillevelo")
     */
    private $velos;

    public function __construct()
    {
        $this->velos = new ArrayCollection();
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

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return Collection|Velo[]
     */
    public function getVelos(): Collection
    {
        return $this->velos;
    }

    public function addVelo(Velo $velo): self
    {
        if (!$this->velos->contains($velo)) {
            $this->velos[] = $velo;
            $velo->setTaillevelo($this);
        }

        return $this;
    }

    public function removeVelo(Velo $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getTaillevelo() === $this) {
                $velo->setTaillevelo(null);
            }
        }

        return $this;
    }
}
