<?php

declare(strict_types=1);

namespace App\Application\User\Command\RegisterAdmin;

use App\Application\Shared\CommandBusHandlerInterface;
use App\Application\User\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;

final class RegisterAdminCommandHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(RegisterAdminCommand $command): void
    {
        $hashedPassword = \password_hash($command->getPassword(), PASSWORD_BCRYPT);

        $user = new User($command->getEmail(), $hashedPassword);

        $this->userRepository->save($user);
    }
}
