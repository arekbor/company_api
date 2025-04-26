<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\UpdateEmployee;

use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class UpdateEmployeeCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository
    ) {}

    public function __invoke(UpdateEmployeeCommand $command): void
    {
        $employeeId = Uuid::fromString($command->getEmployeeId());

        $employee = $this->employeeRepository->getById($employeeId);
        if ($employee === null) {
            throw new EntityNotFoundException('Employee not found');
        }

        $employee->setFirstName($command->getFirstName());
        $employee->setLastName($command->getLastName());
        $employee->setEmail($command->getEmail());
        $employee->setPhone($command->getPhone());

        $this->employeeRepository->save($employee);
    }
}
