<?php

namespace App\Infrastructure\Persistance\Doctrine\Repository;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Repository\ClientRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DomainException;

/**
 * @class ClientOrmRepository
 * @extends ServiceEntityRepository
 * @implements ClientRepository
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Infrastructure\Persistance\Doctrine\Repository
 */

class ClientOrmRepository extends ServiceEntityRepository implements ClientRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        return parent::__construct($registry,Client::class);
    }

    public function findByEmail(string $email): ?Client
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function getByid(int $id): Client
    {
        $client = $this->find($id);

        if( $client === null){
            throw new DomainException("Client qui n'existe encore dans la base");
        }

        return $client;
    }

    public function save(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }

    public function remove(Client $client): void
    {
        $this->getEntityManager()->remove($client);
        $this->getEntityManager()->flush();
    }
}