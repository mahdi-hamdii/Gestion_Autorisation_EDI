<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Poste::class, inversedBy="occupants")
     * @ORM\JoinColumn(nullable=true)
     */
    private $office;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    /**
     * @ORM\Column(type="float")
     */
    private $salaire;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $account;


    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="subordinantes")
     */
    private $employer;

    /**
     * @ORM\OneToMany(targetEntity=Employe::class, mappedBy="employer")
     */
    private $subordinantes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=DemandeConge::class, mappedBy="sender")
     */
    private $demandeConges;


    public function __construct()
    {
        $this->Subordinantes = new ArrayCollection();
        $this->subordinantes = new ArrayCollection();
        $this->demandeConges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffice(): ?Poste
    {
        return $this->office;
    }

    public function setOffice(?Poste $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getAccount(): ?User
    {
        return $this->account;
    }

    public function setAccount(?User $account): self
    {
        $this->account = $account;

        return $this;
    }


    public function getEmployer(): ?self
    {
        return $this->employer;
    }

    public function setEmployer(?self $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubordinantes(): Collection
    {
        return $this->subordinantes;
    }

    public function addSubordinante(self $subordinante): self
    {
        if (!$this->subordinantes->contains($subordinante)) {
            $this->subordinantes[] = $subordinante;
            $subordinante->setEmployer($this);
        }

        return $this;
    }

    public function removeSubordinante(self $subordinante): self
    {
        if ($this->subordinantes->contains($subordinante)) {
            $this->subordinantes->removeElement($subordinante);
            // set the owning side to null (unless already changed)
            if ($subordinante->getEmployer() === $this) {
                $subordinante->setEmployer(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|DemandeConge[]
     */
    public function getDemandeConges(): Collection
    {
        return $this->demandeConges;
    }

    public function addDemandeConge(DemandeConge $demandeConge): self
    {
        if (!$this->demandeConges->contains($demandeConge)) {
            $this->demandeConges[] = $demandeConge;
            $demandeConge->setSender($this);
        }

        return $this;
    }

    public function removeDemandeConge(DemandeConge $demandeConge): self
    {
        if ($this->demandeConges->contains($demandeConge)) {
            $this->demandeConges->removeElement($demandeConge);
            // set the owning side to null (unless already changed)
            if ($demandeConge->getSender() === $this) {
                $demandeConge->setSender(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNom()."  ".$this->getPrenom();
    }

}
