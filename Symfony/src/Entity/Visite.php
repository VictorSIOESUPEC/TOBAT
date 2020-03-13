<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPlaces;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateVisite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bateau", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Bateau;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="visites")
     */
    private $Clients;

    public function __construct()
    {
        $this->Clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(?\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(?\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(?int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->dateVisite;
    }

    public function setDateVisite(?\DateTimeInterface $dateVisite): self
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    public function getBateau(): ?Bateau
    {
        return $this->Bateau;
    }

    public function setBateau(?Bateau $Bateau): self
    {
        $this->Bateau = $Bateau;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->Clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->Clients->contains($client)) {
            $this->Clients[] = $client;
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->Clients->contains($client)) {
            $this->Clients->removeElement($client);
        }

        return $this;
    }
}
