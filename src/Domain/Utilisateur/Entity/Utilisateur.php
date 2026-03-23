<?php

namespace App\Domain\Utilisateur\Entity;

use App\Infrastructure\Persistance\Doctrine\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\Table(name: 'utilisateur')]
class Utilisateur implements UserInterface,PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(unique:true)]
    private string $email;

    #[ORM\Column]
    private string $motDePasse;

    #[ORM\Column]
    private string $nom;

    #[ORM\Column()]
    private string $prenom;


    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(nullable:true)]
    private ?float $tauxHoraire=null; 

    #[ORM\Column]
    private string $devise = 'AR';

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;


    public function __construct(string $email,string $motDePasse,string $nom,string $prenom)
    {
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int{return $this->id;}
    public function getEmail(): string{return $this->email;}
    public function getMotDePasse(): string {return $this->motDePasse;}
    public function getPassword(): ?string{return $this->motDePasse;}
    public function getRoles(): array {return $this->roles;}
    public function eraseCredentials(): void{}
    public function getUserIdentifier(): string{ return $this->email;}

    public function getNom():string {return $this->nom;}
    public function getPrenom():string {return $this->prenom;}
    public function getTauxHoraire():?float {return $this->tauxHoraire;}
    public function getDevise():string {return $this->devise;}
    public function getCreatedAt():\DateTimeImmutable {return $this->createdAt;}
}