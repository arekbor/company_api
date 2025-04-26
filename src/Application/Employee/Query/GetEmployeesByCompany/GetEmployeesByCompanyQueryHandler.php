<?php

declare(strict_types=1);

namespace App\Application\Employee\Query\GetEmployeesByCompany;

use App\Application\Shared\QueryBusHandlerInterface;
use App\Application\Employee\Dto\EmployeeDto;
use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Domain\Entity\Employee;
use Ramsey\Uuid\Uuid;

final class GetEmployeesByCompanyQueryHandler implements QueryBusHandlerInterface
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository
    ) {}

    /**
     * @return EmployeeDto[]
     */
    public function __invoke(GetEmployeesByCompanyQuery $query): array
    {
        $companyId = Uuid::fromString($query->getCompanyId());

        /**
         * @var Employee[] $employees
         */
        $employees = $this->employeeRepository->getEmployeesByCompanyId($companyId);

        /**
         * @var EmployeeDto[] $dto
         */
        $employeeDtos = [];

        foreach ($employees as $employee) {
            $employeeDtos[] = new EmployeeDto(
                $employee->getId()->toString(),
                $employee->getFirstName(),
                $employee->getLastName(),
                $employee->getEmail(),
                $employee->getPhone()
            );
        }

        return $employeeDtos;
    }
}
