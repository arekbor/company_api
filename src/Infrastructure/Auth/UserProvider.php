<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth;

use App\Application\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository) {}

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return Auth::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->getUserByEmail($identifier);
        if ($user === null) {
            throw new UserNotFoundException();
        }

        return new Auth($user->getId(), $user->getEmail(), $user->getPassword());
    }
}
