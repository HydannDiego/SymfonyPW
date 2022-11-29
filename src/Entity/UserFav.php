<?php

namespace App\Entity;

use App\Repository\UserFavRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserFavRepository::class)]
class UserFav
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email_user = null;

    #[ORM\ManyToMany(targetEntity: bien::class, inversedBy: 'userFavs')]
    private Collection $id_bien;

    public function __construct()
    {
        $this->id_bien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailUser(): ?string
    {
        return $this->email_user;
    }

    public function setEmailUser(string $email_user): self
    {
        $this->email_user = $email_user;

        return $this;
    }

    /**
     * @return Collection<int, bien>
     */
    public function getIdBien(): Collection
    {
        return $this->id_bien;
    }

    public function addIdBien(bien $idBien): self
    {
        if (!$this->id_bien->contains($idBien)) {
            $this->id_bien->add($idBien);
        }

        return $this;
    }

    public function removeIdBien(bien $idBien): self
    {
        $this->id_bien->removeElement($idBien);

        return $this;
    }
}
