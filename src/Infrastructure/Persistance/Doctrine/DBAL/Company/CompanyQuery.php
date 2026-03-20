<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistance\Doctrine\DBAL\Company;

use App\Application\Company\ReadModel\CompanyDetailModel;

/**
 * trait CompanyQuery
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Infrastructure\Persistance\Doctrine\DBAL\Company
 */

trait CompanyQuery
{
    private function createBaseQuery()
    {
         return $this->connection->createQueryBuilder()
        ->select('c.id', 'c.name', 'c.siret','c.address','c.email','c.phone')
        ->from('company', 'c');
    }

    private function mapToCompanyModel(array $data): CompanyDetailModel
    {
        return new CompanyDetailModel(
            $data['id'],
            $data['name'],
            $data['siret'],
            $data['address'],
            $data['email'],
            $data['phone']
        );
    }
}
