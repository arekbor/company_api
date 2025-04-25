<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Application\User\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        $this->entityManager->persist($user);
    }
}
