<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Application\Company\Command\DeleteCompanyCommand;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class DeleteCompanyController
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[Route(path: "/api/company/{id}", name: "api_company.delete", methods: ["DELETE"])]
final class DeleteCompanyController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
    }

    public function __invoke(int $id)
    {
        try {
            
            $this->messageBus->dispatch(new DeleteCompanyCommand($id));

            return $this->json([
                'message' => 'Company supprimé avec success',
                'status' => Response::HTTP_NO_CONTENT,
            ], Response::HTTP_NO_CONTENT);
        }catch(DomainException $e){
            return $this->json(['error'=>$e->getMessage(),Response::HTTP_BAD_REQUEST]);
        }
    }
}
