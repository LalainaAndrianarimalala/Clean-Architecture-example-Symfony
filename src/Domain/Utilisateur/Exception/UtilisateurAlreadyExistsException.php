<?php

namespace App\Domain\Utilisateur\Exception;

use DomainException;

class UtilisateurAlreadyExistsException extends DomainException
{
    public function __construct(string $email)
    {
        return parent::__construct("Un utilisateur ave l'email {$email} existe déjà");
    }
}