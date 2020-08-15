<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PosteRepository::class)
 */
class Poste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $office;

    /**
     * @ORM\OneToMany(targetEntity=Employe::class, mappedBy="office")
     */
    private $occupants;

    public function __construct()
    {
        $this->occupants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function setOffice(string $office): self
    {
        $this->office = $office;

        return $this;
    }

    /**
     * @return Collection|Employe[]
     */
    public function getOccupants(): Collection
    {
        return $this->occupants;
    }

    public function addOccupant(Employe $occupant): self
    {
        if (!$this->occupants->contains($occupant)) {
            $this->occupants[] = $occupant;
            $occupant->setOffice($this);
        }

        return $this;
    }

    public function removeOccupant(Employe $occupant): self
    {
        if ($this->occupants->contains($occupant)) {
            $this->occupants->removeElement($occupant);
            // set the owning side to null (unless already changed)
            if ($occupant->getOffice() === $this) {
                $occupant->setOffice(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getOffice();
    }
}
