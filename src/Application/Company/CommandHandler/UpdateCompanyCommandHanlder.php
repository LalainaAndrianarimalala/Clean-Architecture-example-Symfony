<?php

declare(strict_types=1);

namespace App\Application\Company\CommandHandler;

use App\Application\Company\Command\UpdateCompanyCommand;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Repository\CompanyRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class UpdateCompanyCommandHanlder
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[AsMessageHandler()]
final readonly class UpdateCompanyCommandHanlder
{
    public function __construct(
        private CompanyRepository $companyRepository
    )
    {
    }
    public function __invoke(UpdateCompanyCommand $command)
    {
       $company = $this->companyRepository->getById($command->companyId);
       
       $company->update(
        name: $command->name,
        siret: $command->siret,
        address:  $command->address,
        email:  $command->email,
        phone:  $command->phone
       );

       $this->companyRepository->save($company);
    }
}
