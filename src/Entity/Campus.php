<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="campus")
     */
    private $personne_campus;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="campusOrganisateur")
     */
    private $sorties;

    public function __construct()
    {
        $this->personne_campus = new ArrayCollection();
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Personne[]
     */
    public function getPersonneCampus(): Collection
    {
        return $this->personne_campus;
    }

    public function addPersonneCampus(Personne $personneCampus): self
    {
        if (!$this->personne_campus->contains($personneCampus)) {
            $this->personne_campus[] = $personneCampus;
            $personneCampus->setCampus($this);
        }

        return $this;
    }

    public function removePersonneCampus(Personne $personneCampus): self
    {
        if ($this->personne_campus->removeElement($personneCampus)) {
            // set the owning side to null (unless already changed)
            if ($personneCampus->getCampus() === $this) {
                $personneCampus->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->setCampusOrganisateur($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        if ($this->sorties->removeElement($sorty)) {
            // set the owning side to null (unless already changed)
            if ($sorty->getCampusOrganisateur() === $this) {
                $sorty->setCampusOrganisateur(null);
            }
        }

        return $this;
    }
}
