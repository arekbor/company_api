<?php

declare(strict_types=1);

namespace App\Application\Employee\Query\GetEmployee;

use App\Application\Shared\QueryInterface;

final class GetEmployeeQuery implements QueryInterface
{
    private string $employeeId;

    public function __construct(
        string $employeeId
    ) {
        $this->employeeId = $employeeId;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }
}
