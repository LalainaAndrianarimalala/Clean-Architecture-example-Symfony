<?php

namespace App\Application\Client\CommandHandler;

use App\Application\Client\Command\DeleteClientCommand;
use App\Domain\Client\Repository\ClientRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * class DeleteClientHandler
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Application\Client\CommandHandler
 * 
 */


#[AsMessageHandler()]
final readonly class DeleteClientHandler
{
    public function __construct(
        private ClientRepository $clientRepository
    ){}

    public function __invoke(DeleteClientCommand $command)
    {
        $client = $this->clientRepository->getById($command->clientId);
        $this->clientRepository->remove($client);
    }
}