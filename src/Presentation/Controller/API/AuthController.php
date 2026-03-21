<?php

namespace App\Presentation\Controller\API;

use App\Application\Utilisateur\UseCase\LoginUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api')]
final class AuthController extends AbstractController
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase,
        private readonly ValidatorInterface $validator
    )
    {}

    #[Route('/login',name:'api_login',methods:['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(),true) ?? [];

        $constraints = new Assert\Collection([
            'email'=>[new Assert\NotBlank(),new Assert\Email()],
            'motDePasse'=>[new Assert\NotBlank(),new Assert\Length(min: 6, minMessage: "Au moins 6 caractères")],
        ]);

        $errors = $this->validator->validate($data,$constraints);

        if(count($errors)> 0){
            return $this->json(['errors'=>(string) $errors],Response::HTTP_BAD_REQUEST);
        }

        try{
            $result = $this->loginUseCase->execute(
                $data['email'],
                $data['motDePasse']
            );
            return $this->json($result);
        }catch(\Exception $e){
            return $this->json(['error'=>'Invalid credentials'],Response::HTTP_UNAUTHORIZED);
        }

    }
}