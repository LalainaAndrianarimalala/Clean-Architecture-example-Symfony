<?php

namespace App\Application\Client\ReadModel;

/**
 * @class ClientDetailModel
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Application\Client\ReadModel
 * 
 */

final readonly class ClientDetailModel
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $email,
        public string $telephone,
        public string $adresse
    ){}
}