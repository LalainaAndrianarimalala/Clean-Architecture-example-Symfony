<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\DBAL\Company;

use App\Application\Company\Query\GetListCompanyQuery;
use App\Application\Company\QueryHandler\GetListCompanyQueryHandler;
use App\Application\Company\ReadModel\CompanyListModel;
use Doctrine\DBAL\Connection;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class GetListCompanyDbalQuery
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Infrastructure\Persistance\Doctrine\DBAL\Company
 */

#[AsMessageHandler()]
final readonly class GetListCompanyDbalQuery implements GetListCompanyQueryHandler
{
    use CompanyQuery;

    public function __construct(
        private Connection $connection
    )
    {
    }
    public function __invoke(GetListCompanyQuery $query): CompanyListModel
    {
        $data = $this->createBaseQuery()->fetchAllAssociative();

        return new CompanyListModel(
            array_map($this->mapToCompanyModel(...), $data)
        );
    }
}
