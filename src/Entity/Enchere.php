<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnchereRepository")
 */
class Enchere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HistoriqueEnchere", mappedBy="enchere", orphanRemoval=true)
     */
    private $historiqueEnchere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function __construct()
    {
        $this->historiqueEnchere = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * @return Collection|HistoriqueEnchere[]
     */
    public function getHistoriqueEnchere(): Collection
    {
        return $this->historiqueEnchere;
    }

    public function addHistoriqueEnchere(HistoriqueEnchere $historiqueEnchere): self
    {
        if (!$this->historiqueEnchere->contains($historiqueEnchere)) {
            $this->historiqueEnchere[] = $historiqueEnchere;
            $historiqueEnchere->setEnchere($this);
        }

        return $this;
    }

    public function removeHistoriqueEnchere(HistoriqueEnchere $historiqueEnchere): self
    {
        if ($this->historiqueEnchere->contains($historiqueEnchere)) {
            $this->historiqueEnchere->removeElement($historiqueEnchere);
            // set the owning side to null (unless already changed)
            if ($historiqueEnchere->getEnchere() === $this) {
                $historiqueEnchere->setEnchere(null);
            }
        }

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
