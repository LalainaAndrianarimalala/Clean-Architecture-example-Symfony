<?php

namespace App\Domain\Company\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique:true)]
    private string $name;

    #[ORM\Column]
    private string $siret;

    #[ORM\Column]
    private string $address;

    #[ORM\Column()]
    private string $email;

    #[ORM\Column()]
    private string $phone;

    public function __construct(string $name, string $siret, string $address, string $email, string $phone)
    {
        $this->name = $name;
        $this->siret = $siret;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSiret(): string
    {
        return $this->siret;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}