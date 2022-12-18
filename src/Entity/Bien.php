<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $is_locatif = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 5)]
    private ?string $cp = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $id_categorie = null;

    #[ORM\ManyToMany(targetEntity: UserFav::class, mappedBy: 'id_bien')]
    private Collection $userFavs;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    /**
     * @param int|null $id
     * @param string|null $titre
     * @param string|null $description
     * @param bool|null $is_locatif
     * @param int|null $prix
     * @param string|null $ville
     * @param string|null $cp
     * @param int|null $surface
     * @param categorie|null $id_categorie
     * @param Collection $userFavs
     * @param string|null $ref
     */
    public function __construct(?int $id, ?string $titre, ?string $description, ?bool $is_locatif, ?int $prix, ?string $ville, ?string $cp, ?int $surface, ?categorie $id_categorie, ?string $ref)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->is_locatif = $is_locatif;
        $this->prix = $prix;
        $this->ville = $ville;
        $this->cp = $cp;
        $this->surface = $surface;
        $this->id_categorie = $id_categorie;
        $this->userFavs = new ArrayCollection();
        $this->ref = $ref;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isIsLocatif(): ?bool
    {
        return $this->is_locatif;
    }

    public function setIsLocatif(bool $is_locatif): self
    {
        $this->is_locatif = $is_locatif;

        return $this;
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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getIdCategorie(): ?categorie
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?categorie $id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * @return Collection<int, UserFav>
     */
    public function getUserFavs(): Collection
    {
        return $this->userFavs;
    }

    public function addUserFav(UserFav $userFav): self
    {
        if (!$this->userFavs->contains($userFav)) {
            $this->userFavs->add($userFav);
            $userFav->addIdBien($this);
        }

        return $this;
    }

    public function removeUserFav(UserFav $userFav): self
    {
        if ($this->userFavs->removeElement($userFav)) {
            $userFav->removeIdBien($this);
        }

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }
}
