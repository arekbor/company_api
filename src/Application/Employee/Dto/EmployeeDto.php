<?php

declare(strict_types=1);

namespace App\Application\Employee\Dto;

final readonly class EmployeeDto
{
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public ?string $phone;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }
}
