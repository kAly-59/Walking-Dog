<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParcRepository")
 */
class Parc extends Lieux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $autorisation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $horaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutorisation(): ?bool
    {
        return $this->autorisation;
    }

    public function setAutorisation(?bool $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    public function getHoraire(): ?\DateTimeInterface
    {
        return $this->horaire;
    }

    public function setHoraire(?\DateTimeInterface $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }
}
