<?php

declare(strict_types=1);

namespace App\Presentation\Controller\API\Company;

use App\Application\Company\Query\GetListCompanyQuery;
use App\Application\Company\ReadModel\CompanyListModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class GetListCompanyController
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[Route(path: "/api/company/index", name: "api_company.index", methods: ["GET"])]
final class GetListCompanyController extends AbstractController
{

    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus
    ) {}
    
    public function __invoke()
    {
        /**
         * @var CompanyListModel $data
         */
        $data = $this->handle(new GetListCompanyQuery());
       
        return $this->json([
            'status' => 'success',
            'data' => $data->items,
            'message' => 'Companies retrieved successfully'
        ], Response::HTTP_OK); 
    }
}
