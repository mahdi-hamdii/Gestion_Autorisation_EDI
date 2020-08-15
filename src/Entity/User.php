<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *     fields={"email"},
 *     message="l'email que vous aves indiqué est déja utilisé"
 * )
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
     * @ORM\Column(type="string", length=40,unique=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Votre mot de passe doit contenir minimum 8 caractéres")
     * @Assert\EqualTo(propertyPath="confirm_Password",message="mot de passe different")
     */
    private $password;
    /**
     * @Assert\EqualTo(propertyPath="password",message="mot de passe different")
     */

    private $confirm_Password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];




    /**
     * @see UserInterface
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_Password;
    }

    public function setConfirmPassword(string $confirm_Password): self
    {
        $this->confirm_Password = $confirm_Password;

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
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function getRoles()
    {
       return $this->roles;
    }

    public function setRoles(?array $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }


}
