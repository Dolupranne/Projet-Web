<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchatRepository")
 */
class Achat
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
    private $date_achat;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PackJeton", inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $packJetons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="achat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }


    public function getPackJetons(): ?PackJeton
    {
        return $this->packJetons;
    }

    public function setPackJetons(?PackJeton $packJetons): self
    {
        $this->packJetons = $packJetons;

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

    public function __toString() 
    {
        return (string) $this->getId(); 
    }
}
