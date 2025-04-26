<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Domain\Entity\Company;
use App\Domain\Entity\Employee;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

final class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    public function save(Company $company): void
    {
        $this->entityManager->persist($company);
    }

    public function getCompanyById(UuidInterface $id): ?Company
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->select('c')
            ->from(Company::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $id, UuidType::NAME)
        ;

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function remove(Company $company): void
    {
        $this->entityManager->remove($company);
    }

    public function hasEmployees(Company $company): bool
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->select('COUNT(e.id)')
            ->from(Employee::class, 'e')
            ->where('e.company = :company')
            ->setParameter('company', $company)
        ;

        return (int)$queryBuilder->getQuery()->getSingleScalarResult() > 0;
    }
}
