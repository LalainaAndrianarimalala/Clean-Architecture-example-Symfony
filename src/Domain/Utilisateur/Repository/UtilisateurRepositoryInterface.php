<?php

namespace App\Domain\Utilisateur\Repository;

use App\Domain\Utilisateur\Entity\Utilisateur;



interface UtilisateurRepositoryInterface
{
    public function findByEmail(string $emai):?Utilisateur;
    public function save(Utilisateur $utilisateur):void;
}