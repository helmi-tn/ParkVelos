<?php

namespace App\Entity;

use App\Entity\VeloRepositroy;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\TailleVeloRepositroy;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 */
class Participant
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToOne(targetEntity=TailleVelo::class, inversedBy="participant")
     */
    private $taillevelo;

    /**
     * @ORM\OneToMany(targetEntity=Velo::class, mappedBy="participant")
     * @JoinColumn(onDelete="CASCADE")
     */
    private $velos;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="participant")
     */
    private $commandes;

    public function __construct()
    {
        $this->velos = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $velo->setParticipant($this);
        }

        return $this;
    }

    public function removeVelo(Velo $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getParticipant() === $this) {
                $velo->setParticipant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addParticipant($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeParticipant($this);
        }

        return $this;
    }

   
}
