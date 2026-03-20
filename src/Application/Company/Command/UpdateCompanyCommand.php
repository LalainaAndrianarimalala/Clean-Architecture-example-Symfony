<?php

declare(strict_types=1);

namespace App\Application\Company\Command;

/**
 * Class UpdateCompanyCommand
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\Command
 */

final readonly class UpdateCompanyCommand
{
    public function __construct(
        public int $companyId,
        public string $name,
        public string $siret,
        public string $address,
        public string $email,
        public string $phone
    )
    {
    }
}
