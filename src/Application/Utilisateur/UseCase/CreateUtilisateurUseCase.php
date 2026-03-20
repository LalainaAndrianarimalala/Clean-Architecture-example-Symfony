<?php

namespace App\Application\Utilisateur\UseCase;

use App\Application\Utilisateur\Command\CreateUtilisateurCommand;
use App\Domain\Utilisateur\Entity\Utilisateur;
use App\Domain\Utilisateur\Exception\UtilisateurAlreadyExistsException;
use App\Domain\Utilisateur\Repository\UtilisateurRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class CreateUtilisateurUseCase
{
    public function __construct(
        private UtilisateurRepositoryInterface $repository,
        private UserPasswordHasherInterface $passwordHasher
    )
    {}

    public function execute(CreateUtilisateurCommand $command):Utilisateur
    {
        if($this->repository->findByEmail($command->email)){
            throw new UtilisateurAlreadyExistsException($command->email);
        }

        $utilisateur = new Utilisateur(
            $command->email,
            '',
            $command->nom,
            $command->prenom,
        );

        $hashedPassword = $this->passwordHasher->hashPassword($utilisateur,$command->plainPassword);
        $reflection = new \ReflectionProperty(Utilisateur::class,'motDePasse');
        $reflection->setValue($utilisateur,$hashedPassword);

        $this->repository->save($utilisateur);
        return $utilisateur;
    }
}