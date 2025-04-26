<?php

declare(strict_types=1);

namespace App\Application\Company\Command\DeleteCompany;

use App\Application\Shared\CommandInterface;

final class DeleteCompanyCommand implements CommandInterface
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
