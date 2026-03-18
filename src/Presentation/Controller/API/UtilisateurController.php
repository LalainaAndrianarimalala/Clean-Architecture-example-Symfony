<?php

namespace App\Presentation\Controller\API;

use App\Application\Utilisateur\Command\CreateUtilisateurCommand;
use App\Application\Utilisateur\UseCase\CreateUtilisateurUseCase;
use App\Domain\Utilisateur\Exception\UtilisateurAlreadyExistsException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
final class UtilisateurController extends AbstractController
{
    public function __construct(
        private readonly CreateUtilisateurUseCase $useCase,
        private readonly RateLimiterFactoryInterface $createUtilisateurLimiter,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    )
    {}

    #[Route('/utilisateurs',name:'api_utilisateur_create',methods: ['POST','GET'])]
    public function create(Request $request):JsonResponse
    {
        $limiter = $this->createUtilisateurLimiter->create($request->getClientIp() ?? 'anonymous');
        $limit = $limiter->consume(1);

        if( false === $limit->isAccepted()){
            throw new TooManyRequestsHttpException(
                $limit->getRetryAfter()->getTimestamp() - time(),
                'Trop de tentatives de creation .Reesayez dans' .$limit->getRetryAfter()->format('i'). 'minutes'
            );
        }

        $data = json_decode($request->getContent(),true);
        $command = new CreateUtilisateurCommand(
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
        );

        $errors = $this->validator->validate($command);
        if(count($errors) > 0){
            return $this->json(['errors'=> $errors],Response::HTTP_BAD_REQUEST);
        }

        try{
            $utilisateur = $this->useCase->execute($command);
            return $this->json([
                'message'=>'Utilisateur crée avec succès',
                'id'=>$utilisateur->getId(),
                'email'=>$utilisateur->getEmail()
            ],Response::HTTP_CREATED);
        }catch(UtilisateurAlreadyExistsException $e){
            return $this->json(['error'=>$e->getMessage(),Response::HTTP_CONFLICT]);
        }
    }
}