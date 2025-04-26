<?php

declare(strict_types=1);

namespace App\Application\Company\Command\CreateCompany;

use App\Application\Shared\CommandInterface;

final class CreateCompanyCommand implements CommandInterface
{
    private string $name;
    private string $nip;
    private string $address;
    private string $city;
    private string $postalCode;

    public function __construct(
        string $name,
        string $nip,
        string $address,
        string $city,
        string $postalCode
    ) {
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
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
