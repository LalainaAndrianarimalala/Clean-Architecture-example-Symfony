<?php

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Company\Entity\Company;
use App\Domain\Company\Repository\CompanyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DomainException;

class CompanyOrmRepository extends ServiceEntityRepository implements CompanyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class); 
    }

    public function findByEmail(string $email): ?Company
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function getById(int $id): Company
    {
        $company = $this->find($id);

        if ($company === null) {
           throw new DomainException("Company Not Found with ID $id");
        }
        return $company;
    }

    public function save(Company $company): void
    {
        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush();
    }

    public function remove(Company $company): void
    {
        $this->getEntityManager()->remove($company);
        $this->getEntityManager()->flush();
    }
}