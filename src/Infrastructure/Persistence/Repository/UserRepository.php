<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Application\User\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?User
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email, 'string')
        ;

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
    }
}
