<?php

declare(strict_types=1);

namespace App\Application\Company\Query\GetCompany;

use App\Application\Company\Dto\CompanyDto;
use App\Application\Company\Query\GetCompany\GetCompanyQuery;
use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Application\Shared\QueryBusHandlerInterface;
use App\Domain\Exception\EntityNotFoundException;
use Ramsey\Uuid\Uuid;

final class GetCompanyQueryHandler implements QueryBusHandlerInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository
    ) {}

    public function __invoke(GetCompanyQuery $query): CompanyDto
    {
        $companyId = Uuid::fromString($query->getCompanyId());

        $company = $this->companyRepository->getCompanyById($companyId);
        if ($company === null) {
            throw new EntityNotFoundException('Company not found');
        }

        return new CompanyDto(
            $company->getId()->toString(),
            $company->getName(),
            $company->getNip(),
            $company->getAddress(),
            $company->getCity(),
            $company->getPostalCode()
        );
    }
}
