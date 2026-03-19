<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Application\Company\Command\CreateCompanyCommand;
use App\Presentation\WriteModel\CompanyModel;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Class CreateCompanyController
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[Route(path: "/api/company/new", name: "api_company.create", methods: ["POST"])]
final class CreateCompanyController extends AbstractController
{
    public function __invoke(
         #[MapRequestPayload] CompanyModel $model,
         MessageBusInterface $messageBus
    )
    {
        try {
            
            $messageBus->dispatch(new CreateCompanyCommand(
                $model->name,
                $model->siret,
                $model->address,
                $model->email,
                $model->phone
            ));

            return $this->json([
                'message' => 'Company créer avec success',
                'status' => Response::HTTP_CREATED,
            ], Response::HTTP_CREATED);
        }catch(DomainException $e){
            return $this->json(['error'=>$e->getMessage(),Response::HTTP_BAD_REQUEST]);
        }

    }
}
