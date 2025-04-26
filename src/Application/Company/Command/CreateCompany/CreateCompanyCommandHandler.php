<?php

declare(strict_types=1);

namespace App\Application\Company\Command\CreateCompany;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Entity\Company;

final class CreateCompanyCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository
    ) {}

    public function __invoke(CreateCompanyCommand $command): void
    {
        $company = new Company();
        $company->setName($command->getName());
        $company->setNip($command->getNip());
        $company->setAddress($command->getAddress());
        $company->setCity($command->getCity());
        $company->setPostalCode($command->getPostalCode());

        $this->companyRepository->save($company);
    }
}
