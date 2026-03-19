<?php

declare(strict_types=1);

namespace App\Presentation\WriteModel;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CompanyModel
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\WriteModel
 */


final readonly class CompanyModel 
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 50)]
        public string $name,
         #[Assert\NotBlank]
        public string $siret,
         #[Assert\NotBlank]
        public string $address,
         #[Assert\NotBlank]
         #[Assert\Email]
        public string $email,
         #[Assert\NotBlank]
        public string $phone
    )
    {
    }
}
