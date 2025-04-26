<?php

declare(strict_types=1);

namespace App\Application\Company\Repository;

use App\Domain\Entity\Company;
use Ramsey\Uuid\UuidInterface;

interface CompanyRepositoryInterface
{
    public function save(Company $company): void;
    public function getCompanyById(UuidInterface $id): ?Company;
    public function remove(Company $company): void;
    public function hasEmployees(Company $company): bool;
}
