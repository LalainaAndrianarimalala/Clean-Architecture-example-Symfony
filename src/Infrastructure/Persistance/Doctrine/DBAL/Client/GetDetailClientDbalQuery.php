<?php

namespace App\Infrastructure\Persistance\Doctrine\DBAL\Client;

use App\Application\Client\Query\GetDetailsClientQuery;
use App\Application\Client\QueryHandler\GetDetailsClientQueryHandler;
use App\Application\Client\ReadModel\ClientDetailModel;
use Doctrine\DBAL\Connection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * trait ClientQuery
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Infrastructure\Persistance\Doctrine\DBAL\Client
 * 
 */
#[AsMessageHandler()]
 final readonly class GetDetailClientDbalQuery implements GetDetailsClientQueryHandler
 {
    use ClientQuery;

    public function __construct(
        private Connection $connection
    )
    {}

    public function __invoke(GetDetailsClientQuery $query): ClientDetailModel
    {
        $data = $this->createBaseQuery()
                    ->where("cl.id = :clientId")
                    ->setParameter("clientId",$query->clientId)
                    ->fetchAssociative();

        return $this->mapToClientModel($data);
    }
 }