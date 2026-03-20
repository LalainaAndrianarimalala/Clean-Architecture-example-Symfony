<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Application\Company\Command\UpdateCompanyCommand;
use App\Presentation\WriteModel\CompanyModel;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
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
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
    }

    public function __invoke(
         #[MapRequestPayload] CompanyModel $model, int $id   
    )
    {
        try {
            
            $this->messageBus->dispatch(new UpdateCompanyCommand(
                $id,
                $model->name,
                $model->siret,
                $model->address,
                $model->email,
                $model->phone
            ));

            return $this->json([
                'message' => 'Company modifier avec success',
                'status' => Response::HTTP_CREATED,
            ], Response::HTTP_CREATED);
        }catch(DomainException $e){
            return $this->json(['error'=>$e->getMessage(),Response::HTTP_BAD_REQUEST]);
        }
    }
}
