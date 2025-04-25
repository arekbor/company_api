<?php

declare(strict_types=1);

namespace App\Application\User\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function getUserByEmail(string $email): ?User;
}
