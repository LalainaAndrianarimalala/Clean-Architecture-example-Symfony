<?php

namespace App\Application\Client\QueryHandler;

use App\Application\Client\Query\GetDetailsClientQuery;
use App\Application\Client\ReadModel\ClientDetailModel;

/**
 * @class GetDetailsClientQueryHandler
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Application\Client\QueryHandler
 * 
 */

interface GetDetailsClientQueryHandler
{
    public function __invoke(GetDetailsClientQuery $query): ClientDetailModel;
}