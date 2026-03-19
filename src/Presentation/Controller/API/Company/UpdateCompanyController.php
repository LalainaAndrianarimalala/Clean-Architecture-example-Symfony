<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Presentation\WriteModel\CompanyModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class GetListCompanyController
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[Route(path: "/api/company/{id}/edit", name: "api_company.edit", methods: ["PATCH"])]
final class UpdateCompanyController extends AbstractController
{
    public function __invoke(
         #[MapRequestPayload] CompanyModel $model,    
    )
    {
    }
}
