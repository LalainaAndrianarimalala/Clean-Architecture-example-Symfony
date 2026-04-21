<?php

namespace App\Infrastructure\Persistance\Doctrine\DBAL\Client;

use App\Application\Client\ReadModel\ClientDetailModel;

/**
 * trait ClientQuery
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Infrastructure\Persistance\Doctrine\DBAL\Client
 * 
 */

trait ClientQuery
{
    private function createBaseQuery()
    {
        return $this->connection->createQueryBuilder()
                    ->select('cl.id','cl.nom','cl.email','cl.telephone','cl.adresse')
                    ->from('client','cl');
    }

    private function mapToClientModel(array $data):ClientDetailModel
    {
        return new ClientDetailModel(
            $data['id'],
            $data['nom'],
            $data['email'],
            $data['telephone'],
            $data['adresse']
        );
    }
}