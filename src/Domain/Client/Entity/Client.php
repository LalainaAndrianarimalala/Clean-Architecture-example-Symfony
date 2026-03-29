<?php

namespace App\Domain\Client\Entity;

use App\Domain\Company\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'client', cascade: ['persist'])]
    private Company $company;

    #[ORM\Column()]
    private string $nom;

    #[ORM\Column()]
    private string $email;

    #[ORM\Column()]
    private string $telephone;

    #[ORM\Column()]
    private string $adresse;


    public function __construct(Company $company,string $nom,string $email,string $telephone,string $adresse)
    {
        $this->company = $company;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function getNom(): string
    {

        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

}