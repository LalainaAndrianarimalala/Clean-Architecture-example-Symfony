<?php

declare(strict_types=1);

namespace App\Application\Company\QueryHandler;

use App\Application\Company\Query\GetDetailCompanyQuery;
use App\Application\Company\ReadModel\CompanyDetailModel;

/**
 * Class GetDetailCompanyQueryHandler
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\QueryHandler
 */

interface GetDetailCompanyQueryHandler
{
    public function __invoke(GetDetailCompanyQuery $query): CompanyDetailModel;
}
