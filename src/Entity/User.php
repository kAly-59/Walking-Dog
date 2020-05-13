<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields= {"email"},
 *  message= "L'email que vous avez indiqué est déjà utilisé !"
 * )
 * @UniqueEntity(
 *  fields= {"username"},
 *  message= "Nom d'utilisateur que vous avez indiqué est déjà utilisé !"
 * )
 * 
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="4", minMessage="Votre mot de passe doit faire minimum 4 caractères")
     */
    private $password;


    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe n'est pas identique")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="User")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lieux", mappedBy="user")
     */
    private $lieux;

    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Foret", mappedBy="user")
     */
    private $forets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plage", mappedBy="user")
     */
    private $plages;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    

    

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->lieux = new ArrayCollection();
        $this->hotel = new ArrayCollection();
        $this->campings = new ArrayCollection();
        $this->restaurants = new ArrayCollection();
        $this->veterinaires = new ArrayCollection();
        $this->forets = new ArrayCollection();
        $this->plages = new ArrayCollection();
        $this->hotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    
    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Lieux[]
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieux $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux[] = $lieux;
            $lieux->setUser($this);
        }

        return $this;
    }

    public function removeLieux(Lieux $lieux): self
    {
        if ($this->lieux->contains($lieux)) {
            $this->lieux->removeElement($lieux);
            // set the owning side to null (unless already changed)
            if ($lieux->getUser() === $this) {
                $lieux->setUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getRoles()
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    
    public function getImage()
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    

    /**
     * @return Collection|Foret[]
     */
    public function getForets(): Collection
    {
        return $this->forets;
    }

    public function addForet(Foret $foret): self
    {
        if (!$this->forets->contains($foret)) {
            $this->forets[] = $foret;
            $foret->setUser($this);
        }

        return $this;
    }

    public function removeForet(Foret $foret): self
    {
        if ($this->forets->contains($foret)) {
            $this->forets->removeElement($foret);
            // set the owning side to null (unless already changed)
            if ($foret->getUser() === $this) {
                $foret->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plage[]
     */
    public function getPlages(): Collection
    {
        return $this->plages;
    }

    public function addPlage(Plage $plage): self
    {
        if (!$this->plages->contains($plage)) {
            $this->plages[] = $plage;
            $plage->setUser($this);
        }

        return $this;
    }

    public function removePlage(Plage $plage): self
    {
        if ($this->plages->contains($plage)) {
            $this->plages->removeElement($plage);
            // set the owning side to null (unless already changed)
            if ($plage->getUser() === $this) {
                $plage->setUser(null);
            }
        }

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    

    
    

    

    
}
