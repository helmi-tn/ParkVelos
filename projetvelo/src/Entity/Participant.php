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
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="participant")
     */
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity=Velo::class, inversedBy="participants")
     */
    private $velo;

    public function __construct()
    {
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

    public function getVelo(): ?Velo
    {
        return $this->velo;
    }

    public function setVelo(?Velo $velo): self
    {
        $this->velo = $velo;

        return $this;
    }

   
}
