<?php

declare(strict_types=1);

namespace App\Application\Employee\Command\AddEmployeeToCompany;

use App\Application\Shared\CommandInterface;

final class AddEmployeeToCompanyCommand implements CommandInterface
{
    private string $companyId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phone = null;

    public function __construct(
        string $companyId,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone = null
    ) {
        $this->companyId = $companyId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
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
