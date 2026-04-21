<?php

namespace App\Application\Client\Query;

/**
 * @class GetDetailsClientQuery
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Application\Client\Query
 * 
 */

final readonly class GetDetailsClientQuery
{
    public function __construct(
        public int $clientId
    )
    {
    }
}