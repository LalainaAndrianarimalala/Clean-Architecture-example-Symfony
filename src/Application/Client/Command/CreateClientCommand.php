<?php

namespace App\Application\Client\Command;

/**
 * class CreateClientCommand
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Application\Client\Command
 */
final readonly class CreateClientCommand
{
    public function __construct(
        public string $nom,
        public string $email,
        public string $telephone,
        public string $adresse
    )
    {}
}
