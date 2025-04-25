<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class Auth implements UserInterface, PasswordHasherAwareInterface, PasswordAuthenticatedUserInterface, \Stringable
{
    public function __construct(
        private readonly UuidInterface $uuid,
        private readonly string $email,
        private readonly string $hashedPassword
    ) {}

    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function eraseCredentials(): void {}

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPasswordHasherName(): ?string
    {
        return 'hasher';
    }

    public function getPassword(): ?string
    {
        return $this->hashedPassword;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
