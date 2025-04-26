<?php

declare(strict_types=1);

namespace App\Application\Company\Command\UpdateCompany;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class UpdateCompanyCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository
    ) {}

    public function __invoke(UpdateCompanyCommand $command): void
    {
        $companyId = Uuid::fromString($command->getCompanyId());

        $company = $this->companyRepository->getCompanyById($companyId);
        if ($company === null) {
            throw new EntityNotFoundException('Company not found');
        }

        $company->setName($command->getName());
        $company->setNip($command->getNip());
        $company->setAddress($command->getAddress());
        $company->setCity($command->getCity());
        $company->setPostalCode($command->getPostalCode());

        $this->companyRepository->save($company);
    }
}
