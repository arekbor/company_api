<?php

declare(strict_types=1);

namespace App\Application\Company\Command\UpdateCompany;

use App\Application\Shared\CommandInterface;

final class UpdateCompanyCommand implements CommandInterface
{
    private string $companyId;
    private string $name;
    private string $nip;
    private string $address;
    private string $city;
    private string $postalCode;

    public function __construct(
        string $companyId,
        string $name,
        string $nip,
        string $address,
        string $city,
        string $postalCode
    ) {
        $this->companyId = $companyId;
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
}
