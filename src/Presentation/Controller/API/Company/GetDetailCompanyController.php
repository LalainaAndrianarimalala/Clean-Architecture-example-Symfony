<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Application\Company\Query\GetDetailCompanyQuery;
use App\Application\Company\ReadModel\CompanyListModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

/**
 * Class GetListCompanyController
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[Route(path: "/api/company/{id}", name: "api_company.show", methods: ["GET"], requirements: [ 'id' => Requirement::DIGITS ])]
final class GetDetailCompanyController extends AbstractController
{

    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus
    ) {}
    
    public function __invoke(int $id)
    {
        /**
         * @var CompanyListModel $data
         */
        $data = $this->handle(new GetDetailCompanyQuery($id));
       
        return $this->json([
            'status' => 'success',
            'data' => $data,
            'message' => 'Companies retrieved successfully'
        ], Response::HTTP_OK); 
    }
}
