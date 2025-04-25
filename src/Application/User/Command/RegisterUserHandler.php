<?php

declare(strict_types=1);

namespace App\Application\User\Command;

use App\Application\Shared\CommandBusHandlerInterface;
use App\Application\User\Repository\UserRepositoryInterface;

final class RegisterUserHandler implements CommandBusHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(RegisterUser $command): void
    {
        dd($command);
    }
}
