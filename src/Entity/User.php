<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use App\form\RegistrationType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 8,
     * minMessage = "Votre mot de passe doit contenir minimum 8 caractères")
     */
    private $password;

    /**
     * @Assert\EqualTo(
     * propertyPath = "password",
     * message = "Les mot de passe ne sont pas identiques")
     */
    private $confirm_password;

    /**
     * @Assert\EqualTo(
     * propertyPath = "username",
     * message = "Les pseudos ne sont pas identiques")
     */
    private $confirm_new_username;

    private $confirm_new_password;

    public function __toString()
    {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    public function getConfirmNewUsername(): ?string
    {
        return $this->confirm_new_username;
    }

    public function setConfirmNewUsername(string $confirm_new_username): self
    {
        $this->confirm_new_username = $confirm_new_username;

        return $this;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getUserIdentifier(): ?string
    {
        return '';
    }
}
