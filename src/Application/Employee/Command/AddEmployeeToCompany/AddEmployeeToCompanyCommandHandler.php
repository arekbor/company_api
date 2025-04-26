<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\AddEmployeeToCompany;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Entity\Employee;
use App\Domain\Entity\Company;
use App\Domain\Exception\EmployeeAlreadyExistsInCompanyException;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class AddEmployeeToCompanyCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly EmployeeRepositoryInterface $employeeRepository,
    ) {}

    public function __invoke(AddEmployeeToCompanyCommand $command): void
    {
        $companyId = Uuid::fromString($command->getCompanyId());

        /**
         * @var Company $company
         */
        $company = $this->companyRepository->getCompanyById($companyId);
        if ($company === null) {
            throw new EntityNotFoundException("Company not found");
        }

        if ($this->employeeRepository->existsEmployeeInCompany($command->getEmail(), $companyId)) {
            throw new EmployeeAlreadyExistsInCompanyException();
        }

        $employee = new Employee();
        $employee->setFirstName($command->getFirstName());
        $employee->setLastName($command->getLastName());
        $employee->setEmail($command->getEmail());
        $employee->setPhone($command->getPhone());

        $company->addEmployee($employee);

        $this->companyRepository->save($company);
    }
}
