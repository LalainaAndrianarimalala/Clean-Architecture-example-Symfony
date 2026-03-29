<?php

namespace App\Application\Client\Command;


/**
 * class DeleteClientCommand
 * 
 * @LalainaAndrianarimalala andrilalaina144@gmail.com
 * @package App\Application\Client\Command
 */

final readonly class DeleteClientCommand
{
    public function __construct(
        public int $clientId
    ){}
}