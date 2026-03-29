<?php

namespace App\Domain\Company\Entity;

use App\Domain\Client\Entity\Client;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: Client::class,mappedBy: 'company')]
    private Collection $client;

    public function __construct(string $name, string $siret, string $address, string $email, string $phone)
    {
        $this->client = new ArrayCollection();
        $this->name = $name;
        $this->siret = $siret;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function update(
        string $name, string $siret, string $address, string $email, string $phone
    )
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

    public function getClient(): Collection
    {
        return $this->client;
    }
}