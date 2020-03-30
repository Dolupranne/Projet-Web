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
}
