<?php

namespace App\Domain\Client\Repository;

use App\Domain\Client\Entity\Client;

/**
 * @interface ClientRepository
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Domain\Client\Repository
 */

interface ClientRepository
{
    public function findByEmail(string $email): ?Client;
    public function getByid(int $id): Client;
    public function save(Client $client):void;
    public function remove(Client $client): void;
} 