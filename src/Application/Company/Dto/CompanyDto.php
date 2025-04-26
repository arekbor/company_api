<?php

declare(strict_types=1);

namespace App\Application\Company\Dto;

final readonly class CompanyDto
{
    public string $id;
    public string $name;
    public string $nip;
    public string $address;
    public string $city;
    public string $postalCode;

    public function __construct(
        string $id,
        string $name,
        string $nip,
        string $address,
        string $city,
        string $postalCode,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
    }
}
