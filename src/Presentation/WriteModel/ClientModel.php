<?php

namespace App\Presentation\WriteModel;

use App\Domain\Client\Entity\Client;
use App\Domain\Company\Entity\Company;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * class ClientModel
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Presentation\WriteModel
 */

final readonly class ClientModel
{
    public function __construct(
        #[Assert\NotBlank]
        public array $company,
        #[Assert\NotBlank]
        public string $nom,
        #[Assert\NotBlank]
        public string $email,
        #[Assert\NotBlank]
        public string $telephone,
        #[Assert\NotBlank]
        public string $adresse,


    ){}

    public static function createModel(Client $client)
    {
        return new self(
            [
                'id' => $client->getCompany()->getId(),
                'name' => $client->getCompany()->getName(),
                'siret' => $client->getCompany()->getSiret(),
                'address' => $client->getCompany()->getAddress(),
                'email' => $client->getCompany()->getEmail(),
                'phone' => $client->getCompany()->getPhone()
            ],
            $client->getNom(),
            $client->getEmail(),
            $client->getTelephone(),
            $client->getAdresse()
        );
    }
}