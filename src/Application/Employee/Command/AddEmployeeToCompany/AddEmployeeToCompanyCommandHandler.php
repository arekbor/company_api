<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\AddEmployeeToCompany;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Entity\Employee;
use App\Domain\Entity\Company;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            throw new NotFoundHttpException('Company not found');
        }

        if ($this->employeeRepository->existsEmployeeInCompany($command->getEmail(), $companyId)) {
            throw new BadRequestHttpException('Employee by provided email already exists in this company.');
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
