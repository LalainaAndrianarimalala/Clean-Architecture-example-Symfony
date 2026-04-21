<?php

namespace App\Presentation\Controller\API\client;

use App\Application\Client\Command\DeleteClientCommand;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/delete/client/{id}',name: 'api_delete_client',methods:["DELETE"])]
final class DeleteClientController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    ){}

    public function __invoke(int $id)
    {
        try {
            $this->messageBus->dispatch(new DeleteClientCommand($id));
                
            return $this->json([
                'message' => 'Client suprimé avec succes',
                'status'=> Response::HTTP_NO_CONTENT
            ]);
        } catch (DomainException $e) {
            return $this->json(['error'=>$e->getMessage(),Response::HTTP_BAD_REQUEST]);
        }
    }
}