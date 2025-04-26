<?php

declare(strict_types=1);

namespace App\Application\Company\Query\GetCompany;

use App\Application\Shared\QueryInterface;

final class GetCompanyQuery implements QueryInterface
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
