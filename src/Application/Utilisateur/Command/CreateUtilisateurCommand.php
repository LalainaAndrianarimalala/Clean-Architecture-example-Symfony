<?php

namespace App\Application\Utilisateur\Command;

final readonly class CreateUtilisateurCommand
{
    public function __construct(
        public string $email,
        public string $plainPassword,
        public string $nom,
        public string $prenom,
        public string $tauxHoraire
    )
    {}
}