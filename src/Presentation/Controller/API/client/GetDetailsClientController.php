<?php

namespace App\Presentation\Controller\API\client;

use App\Application\Client\Query\GetDetailsClientQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * class GetDetailsClientController
 * 
 * @author andrilalaina144@gmail.com
 * @package App\Presentation\Controller\API\client
 * 
 */
#[Route('api/client/{id}',name:'api_client.show',methods:["GET"])]
 final class GetDetailsClientController extends AbstractController
 {
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus
    )
    {}

    public function __invoke(int $id)
    {
        $data = $this->handle(new GetDetailsClientQuery($id));

        return $this->json([
            'status'=>'success',
            'data'=>$data,
            'message'=>'Client afficher avec succes'
        ],Response::HTTP_OK);
    }
 }

