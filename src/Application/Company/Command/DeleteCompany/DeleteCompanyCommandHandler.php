<?php

declare(strict_types=1);

namespace App\Application\Company\Command\DeleteCompany;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Exception\CannotDeleteCompanyWithEmployeesException;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class DeleteCompanyCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository
    ) {}

    public function __invoke(DeleteCompanyCommand $command): void
    {
        $companyId = Uuid::fromString($command->getCompanyId());

        $company = $this->companyRepository->getCompanyById($companyId);
        if ($company === null) {
            throw new EntityNotFoundException('Company not found');
        }

        if ($this->companyRepository->hasEmployees($company)) {
            throw new CannotDeleteCompanyWithEmployeesException();
        }

        $this->companyRepository->remove($company);
    }
}
