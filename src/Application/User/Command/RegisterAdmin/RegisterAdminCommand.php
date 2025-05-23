<?php

declare(strict_types=1);

namespace App\Application\User\Command\RegisterAdmin;

use App\Application\Shared\CommandInterface;

final class RegisterAdminCommand implements CommandInterface
{
    private string $email;
    private string $password;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
