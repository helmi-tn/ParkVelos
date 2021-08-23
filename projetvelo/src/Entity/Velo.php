<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VeloRepository;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=VeloRepository::class)
 */
class Velo
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponibilite;

    /**
     * @ORM\ManyToOne(targetEntity=TailleVelo::class, inversedBy="velos")
     */
    private $taillevelo;

    /**
     * @ORM\OneToMany(targetEntity=Participant::class, mappedBy="velo")
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }



 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getTaillevelo(): ?TailleVelo
    {
        return $this->taillevelo;
    }

    public function setTaillevelo(?TailleVelo $taillevelo): self
    {
        $this->taillevelo = $taillevelo;

        return $this;
    }


    public function displayPhoto()
    {
        if($this->image !== null) {
            $this->image = "../../uploads/velo_image/" . $this->getImage();
            return $this->image;
        }
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setVelo($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getVelo() === $this) {
                $participant->setVelo(null);
            }
        }

        return $this;
    }

   

}
