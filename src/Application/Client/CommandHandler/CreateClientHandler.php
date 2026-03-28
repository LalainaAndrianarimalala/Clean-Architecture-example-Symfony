<?php

declare(strict_types=1);

namespace App\Application\Client\CommandHandler;

use App\Application\Client\Command\CreateClientCommand;
use App\Domain\Client\Entity\Client;
use App\Domain\Client\Exception\EmailAlreadyExistException;
use App\Domain\Client\Repository\ClientRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * class CreateClientHandler
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Application\Client\CommandHandler
 */

#[AsMessageHandler()]
 final readonly class CreateClientHandler
 {
    public function __construct(
        private ClientRepository $clientRepository
    )
    {}

    public function __invoke(CreateClientCommand $command)
    {

        if($this->clientRepository->findByEmail($command->email)){
            throw new EmailAlreadyExistException($command->email);
        }

        $client = new Client(
            nom: $command->nom,
            email: $command->email,
            telephone: $command->telephone,
            adresse: $command->adresse
       );
        
        $this->clientRepository->save($client);    
    }
 }

 