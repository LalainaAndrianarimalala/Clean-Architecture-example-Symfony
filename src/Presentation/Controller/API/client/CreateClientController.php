<?php

namespace App\Presentation\Controller\API\client;

use App\Application\Client\Command\CreateClientCommand;
use App\Presentation\WriteModel\ClientModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * class CreateClientController
 * @extends AbstractController
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Presentation\Controller\API\client
 */

 #[Route("api/client/nouveau",name:"api_client_nouveau",methods:["POST"])]
 final class CreateClientController extends AbstractController
 {
    public function __invoke(
        #[MapRequestPayload()] ClientModel $model,
        MessageBusInterface $messageBus
    )
    {
        try {
            $messageBus->dispatch(
                new CreateClientCommand(
                    $model->company,
                    $model->nom,
                    $model->email,
                    $model->telephone,
                    $model->adresse
                )
                );

                return $this->json([
                    'message'=>'Client créer avec succes !',
                    'status'=>Response::HTTP_CREATED
                ]);
        } catch (\DomainException $e) {
            return $this->json(['error'=>$e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }
 }