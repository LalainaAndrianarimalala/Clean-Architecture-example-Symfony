<?php

declare(strict_types=1);

namespace App\Application\Company\QueryHandler;

use App\Application\Company\Query\GetListCompanyQuery;
use App\Application\Company\ReadModel\CompanyListModel;

/**
 * Class GetListCompanyQueryHandler
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\QueryHandler
 */

interface GetListCompanyQueryHandler
{
    public function __invoke(GetListCompanyQuery $query): CompanyListModel;
}
