<?php

declare(strict_types=1);

namespace App\Application\Company\CommandHandler;

use App\Application\Company\Command\DeleteCompanyCommand;
use App\Domain\Company\Repository\CompanyRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class DeleteCompanyCommandHanlder
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[AsMessageHandler()]
final readonly class DeleteCompanyCommandHanlder
{
    public function __construct(
        private CompanyRepository $companyRepository
    )
    {
    }
    public function __invoke(DeleteCompanyCommand $command)
    {
       $company = $this->companyRepository->getById($command->companyId);

       $this->companyRepository->remove($company);
    }
}
