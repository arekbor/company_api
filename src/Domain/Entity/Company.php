<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Company extends AbstractEntity
{
    private string $name;
    private string $nip;
    private string $address;
    private string $city;
    private string $postalCode;

    /**
     * @var Employee[]
     */
    private $employees;

    public function __construct()
    {
        $this->employees = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function setNip(string $nip): static
    {
        $this->nip = $nip;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return Employee[]
     */
    public function getEmployees(): mixed
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): void
    {
        $employee->setCompany($this);

        $this->employees[] = $employee;
    }
}
