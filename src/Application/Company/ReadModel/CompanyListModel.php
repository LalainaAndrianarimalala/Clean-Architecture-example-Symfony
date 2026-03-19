<?php

declare(strict_types=1);

namespace App\Application\Company\ReadModel;


/**
 * Class CompanyListModel
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Application\Company\ReadModel
 */

final readonly class CompanyListModel
{
    public function __construct(
        public array $items
    )
    {
    }
}
