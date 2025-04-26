<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Entity\AbstractEntity;

final class User extends AbstractEntity
{
    private string $email;
    private string $password;

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
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
