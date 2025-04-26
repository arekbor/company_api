<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\DeleteEmployee;

use App\Application\Shared\CommandInterface;

final class DeleteEmployeeCommand implements CommandInterface
{
    private string $employeeId;

    public function __construct(string $employeeId)
    {
        $this->employeeId = $employeeId;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }
}
