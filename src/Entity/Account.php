<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['account:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['account:read'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['account:read'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['account:read'])]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function __toString()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
