<?php

declare(strict_types=1);

namespace App\Application\Employee\Query\GetEmployeesByCompany;

use App\Application\Shared\QueryInterface;

final class GetEmployeesByCompanyQuery implements QueryInterface
{
    private string $companyId;

    public function __construct(
        string $companyId
    ) {
        $this->companyId = $companyId;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }
}
