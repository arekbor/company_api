<?php

declare(strict_types=1);

namespace App\Application\Employee\Query\GetEmployee;

use App\Application\Employee\Dto\EmployeeDto;
use App\Application\Employee\Query\GetEmployee\GetEmployeeQuery;
use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Application\Shared\QueryBusHandlerInterface;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class GetEmployeeQueryHandler implements QueryBusHandlerInterface
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository
    ) {}

    public function __invoke(GetEmployeeQuery $query): EmployeeDto
    {
        $employeeId = Uuid::fromString($query->getEmployeeId());

        $employee = $this->employeeRepository->getById($employeeId);
        if ($employee == null) {
            throw new EntityNotFoundException('Employee not found');
        }

        return new EmployeeDto(
            $employee->getId()->toString(),
            $employee->getFirstName(),
            $employee->getLastName(),
            $employee->getEmail(),
            $employee->getPhone()
        );
    }
}
