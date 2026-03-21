<?php

namespace App\Application\Utilisateur\UseCase;

use App\Domain\Utilisateur\Repository\UtilisateurRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class LoginUseCase
{
    public function __construct(
        private UtilisateurRepositoryInterface $utilisateurRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private JWTTokenManagerInterface $jwtManager
    )
    {}

    public function execute(string $email,string $plainPassword): array
    {
        $user = $this->utilisateurRepository->findByEmail($email);

        if(!$user || !$this->passwordHasher->isPasswordValid($user,$plainPassword))
        {
            throw new BadCredentialsException(('Invalide credentials'));
        }

        $token = $this->jwtManager->create($user);

        return [
            'token'=>$token,
            'user'=>[
                'id'=>$user->getId(),
                'email'=>$user->getEmail(),
                'roles'=>$user->getRoles()
            ]
        ];
    }
}