<?php

namespace App\Entity;

use App\Repository\DemandeCongeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeCongeRepository::class)
 */
class DemandeConge
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeFormulation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motifs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="demandeConges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sender;

    /**
     * @ORM\Column(type="integer")
     */
    private $superiorId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="demandeConges")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateDeFormulation(): ?\DateTimeInterface
    {
        return $this->dateDeFormulation;
    }

    public function setDateDeFormulation(\DateTimeInterface $dateDeFormulation): self
    {
        $this->dateDeFormulation = $dateDeFormulation;

        return $this;
    }

    public function getMotifs(): ?string
    {
        return $this->motifs;
    }

    public function setMotifs(string $motifs): self
    {
        $this->motifs = $motifs;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getSender(): ?Employe
    {
        return $this->sender;
    }

    public function setSender(?Employe $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getSuperiorId(): ?int
    {
        return $this->superiorId;
    }

    public function setSuperiorId(int $superiorId): self
    {
        $this->superiorId = $superiorId;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }


}
