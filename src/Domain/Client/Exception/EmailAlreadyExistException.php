<?php

namespace App\Domain\Client\Exception;

use DomainException;

class EmailAlreadyExistException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct(" {$email} deja exister dans la base ");
    }
}