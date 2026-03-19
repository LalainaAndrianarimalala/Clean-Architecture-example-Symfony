<?php

declare(strict_types=1);

namespace App\Application\Company\ReadModel;


/**
 * Class CompanyDetailModel
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\ReadModel
 */

final readonly class CompanyDetailModel
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
