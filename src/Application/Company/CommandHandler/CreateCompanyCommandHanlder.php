<?php

declare(strict_types=1);

namespace App\Application\Company\CommandHandler;

use App\Application\Company\Command\CreateCompanyCommand;
use App\Domain\Company\Entity\Company;
use App\Domain\Company\Repository\CompanyRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

/**
 * Class CreateCompanyCommandHanlder
 * 
 * @author Eloi Charly <nandry556@gmail.com>
 * @package App\Presentation\Controller\API\Company
 */

#[AsMessageHandler()]
final readonly class CreateCompanyCommandHanlder
{
    public function __construct(
        private CompanyRepository $companyRepository
    )
    {
    }
    public function __invoke(CreateCompanyCommand $command)
    {
       $company = new Company(
        name: $command->name,
        siret: $command->siret,
        address:  $command->address,
        email:  $command->email,
        phone:  $command->phone
       );

       $this->companyRepository->save($company);
    }
}
