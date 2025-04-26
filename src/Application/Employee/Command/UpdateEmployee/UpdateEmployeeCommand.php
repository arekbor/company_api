<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\UpdateEmployee;

use App\Application\Shared\CommandInterface;

final class UpdateEmployeeCommand implements CommandInterface
{
    private string $employeeId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phone;

    public function __construct(
        string $employeeId,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone = null
    ) {
        $this->employeeId = $employeeId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
