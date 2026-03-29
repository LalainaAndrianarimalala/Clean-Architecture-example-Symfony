<?php

namespace App\Application\Client\Command;

use App\Domain\Company\Entity\Company;

/**
 * class CreateClientCommand
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Application\Client\Command
 */
final readonly class CreateClientCommand
{
    public function __construct(
        public array $company,
        public string $nom,
        public string $email,
        public string $telephone,
        public string $adresse
    )
    {}
}
