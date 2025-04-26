<?php

declare(strict_types=1);

namespace App\Application\Employee\Repository;

use App\Domain\Entity\Employee;
use Ramsey\Uuid\UuidInterface;

interface EmployeeRepositoryInterface
{
    public function existsEmployeeInCompany(string $email, UuidInterface $companyId): bool;
    public function remove(Employee $employee): void;
    public function getById(UuidInterface $id): ?Employee;
    public function save(Employee $employee): void;
}
