<?php

declare(strict_types=1);

namespace App\Application\Company\Query;

/**
 * Class GetDetailCompany
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\Query
 */

final readonly class GetDetailCompanyQuery
{
    public function __construct(
        public int $companyId
    )
    {
    }
}
