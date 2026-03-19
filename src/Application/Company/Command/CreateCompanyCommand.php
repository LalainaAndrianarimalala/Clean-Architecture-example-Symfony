<?php

declare(strict_types=1);

namespace App\Application\Company\Command;

/**
 * Class CreateCompanyCommand
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\Command
 */

final readonly class CreateCompanyCommand
{
    public function __construct(
        public string $name,
        public string $siret,
        public string $address,
        public string $email,
        public string $phone
    )
    {
    }
}
