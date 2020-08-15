<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=DemandeConge::class, mappedBy="type")
     */
    private $demandeConges;

    public function __construct()
    {
        $this->demandeConges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
    public function __toString()
    {
        return $this->getType();
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
            $demandeConge->setType($this);
        }

        return $this;
    }

    public function removeDemandeConge(DemandeConge $demandeConge): self
    {
        if ($this->demandeConges->contains($demandeConge)) {
            $this->demandeConges->removeElement($demandeConge);
            // set the owning side to null (unless already changed)
            if ($demandeConge->getType() === $this) {
                $demandeConge->setType(null);
            }
        }

        return $this;
    }
}
