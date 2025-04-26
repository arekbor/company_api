<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\DeleteEmployee;

use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Application\Shared\CommandBusHandlerInterface;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class DeleteEmployeeCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly EmployeeRepositoryInterface $employeeRepository
    ) {}

    public function __invoke(DeleteEmployeeCommand $command): void
    {
        $employeeId = Uuid::fromString($command->getEmployeeId());

        $employee = $this->employeeRepository->getById($employeeId);
        if ($employee === null) {
            throw new EntityNotFoundException('Employee not found');
        }

        $this->employeeRepository->remove($employee);
    }
}
