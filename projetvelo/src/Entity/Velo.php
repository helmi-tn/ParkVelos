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
     * @ORM\ManyToOne(targetEntity=Participant::class, inversedBy="velos")
     * @ORM\JoinColumn(name="participant_id",referencedColumnName="id", nullable=true, onDelete="CASCADE")    
     */
    private $participant;

 


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

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

}
