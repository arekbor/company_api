<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Application\Employee\Repository\EmployeeRepositoryInterface;
use App\Domain\Entity\Employee;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

final class EmployeeRepository extends AbstractRepository implements EmployeeRepositoryInterface
{
    public function existsEmployeeInCompany(string $email, UuidInterface $companyId): bool
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->select('e')
            ->from(Employee::class, 'e')
            ->where('e.company = :companyId')
            ->andWhere('e.email = :email')
            ->setParameter('companyId', $companyId, UuidType::NAME)
            ->setParameter('email', $email, 'string')
            ->setMaxResults(1)
        ;

        return $queryBuilder->getQuery()->getOneOrNullResult() ? true : false;
    }
}
