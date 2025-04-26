<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Application\Company\Repository\CompanyRepositoryInterface;
use App\Domain\Entity\Company;
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
}
