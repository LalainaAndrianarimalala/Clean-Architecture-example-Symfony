<?php

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Utilisateur\Entity\Utilisateur;
use App\Domain\Utilisateur\Repository\UtilisateurRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UtilisateurRepository extends ServiceEntityRepository implements UtilisateurRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class); // ✅ suppression de $entityClass
    }

    public function findByEmail(string $email): ?Utilisateur // ✅ typo $emai corrigé
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function save(Utilisateur $utilisateur): void
    {
        $this->getEntityManager()->persist($utilisateur);
        $this->getEntityManager()->flush();
    }
}