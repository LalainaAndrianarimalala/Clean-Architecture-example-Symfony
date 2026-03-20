<?php

declare(strict_types=1);

namespace App\Application\Company\Command;

/**
 * Class DeleteCompanyCommand
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\Command
 */

final readonly class DeleteCompanyCommand
{
    public function __construct(
        public int $companyId
    )
    {
    }
}
