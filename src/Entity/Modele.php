<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
#[ApiResource()]

class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?int $pages_comprises = null;

    #[ORM\Column]
    private ?int $nbPhotos = null;

    #[ORM\Column]
    private ?int $nbTexte = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Site::class, orphanRemoval: true)]
    private Collection $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPagesComprises(): ?int
    {
        return $this->pages_comprises;
    }

    public function setPagesComprises(int $pages_comprises): self
    {
        $this->pages_comprises = $pages_comprises;

        return $this;
    }

    public function getNbPhotos(): ?int
    {
        return $this->nbPhotos;
    }

    public function setNbPhotos(int $nbPhotos): self
    {
        $this->nbPhotos = $nbPhotos;

        return $this;
    }

    public function getNbTexte(): ?int
    {
        return $this->nbTexte;
    }

    public function setNbTexte(int $nbTexte): self
    {
        $this->nbTexte = $nbTexte;

        return $this;
    }

    /**
     * @return Collection<int, Site>
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites->add($site);
            $site->setModele($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getModele() === $this) {
                $site->setModele(null);
            }
        }

        return $this;
    }
}
