<?php

declare(strict_types=1);

namespace App\Application\User\Command\RegisterAdmin;

use App\Application\Shared\CommandBusHandlerInterface;
use App\Application\User\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

final class RegisterAdminCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly PasswordHasherInterface $passwordHasher
    ) {}

    public function __invoke(RegisterAdminCommand $command): void
    {
        $hashedPassword = $this->passwordHasher->hash($command->getPassword());

        $user = new User($command->getEmail(), $hashedPassword);

        $this->userRepository->save($user);
    }
}
