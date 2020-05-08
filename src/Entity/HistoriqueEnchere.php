<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoriqueEnchereRepository")
 */
class HistoriqueEnchere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enchere;

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enchere", inversedBy="historiqueEnchere")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enchere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="historiqueEnchere")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateEnchere(): ?\DateTimeInterface
    {
        return $this->date_enchere;
    }

    public function setDateEnchere(\DateTimeInterface $date_enchere): self
    {
        $this->date_enchere = $date_enchere;

        return $this;
    }



    public function getEnchere(): ?Enchere
    {
        return $this->enchere;
    }

    public function setEnchere(?Enchere $enchere): self
    {
        $this->enchere = $enchere;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    
}
