<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\DBAL\Company;

use App\Application\Company\Query\GetDetailCompanyQuery;
use App\Application\Company\QueryHandler\GetDetailCompanyQueryHandler;
use App\Application\Company\ReadModel\CompanyDetailModel;
use Doctrine\DBAL\Connection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class GetDetailCompanyDbalQuery
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Infrastructure\Persistance\Doctrine\DBAL\Company
 */

#[AsMessageHandler()]
final readonly class GetDetailCompanyDbalQuery implements GetDetailCompanyQueryHandler
{
    use CompanyQuery;

    public function __construct(
        private Connection $connection
    )
    {
    }
    public function __invoke(GetDetailCompanyQuery $query): CompanyDetailModel
    {
        $data = $this->createBaseQuery()
            ->where("c.id = :companyId")
            ->setParameter("companyId", $query->companyId)
            ->fetchAssociative();

        return $this->mapToCompanyModel($data);
    }
}
