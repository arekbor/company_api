<?php

declare(strict_types=1);

namespace App\Application\Employee\Repository;

use Ramsey\Uuid\UuidInterface;

interface EmployeeRepositoryInterface
{
    public function existsEmployeeInCompany(string $email, UuidInterface $companyId): bool;
}
