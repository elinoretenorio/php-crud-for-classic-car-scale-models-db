<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Customers;

use JsonSerializable;

class CustomersModel implements JsonSerializable
{
    private int $customerNumber;
    private string $customerName;
    private string $contactLastName;
    private string $contactFirstName;
    private string $phone;
    private string $addressLine1;
    private string $addressLine2;
    private string $city;
    private string $state;
    private string $postalCode;
    private string $country;
    private int $employeeNumber;
    private float $creditLimit;

    public function __construct(CustomersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customerNumber = $dto->customerNumber;
        $this->customerName = $dto->customerName;
        $this->contactLastName = $dto->contactLastName;
        $this->contactFirstName = $dto->contactFirstName;
        $this->phone = $dto->phone;
        $this->addressLine1 = $dto->addressLine1;
        $this->addressLine2 = $dto->addressLine2;
        $this->city = $dto->city;
        $this->state = $dto->state;
        $this->postalCode = $dto->postalCode;
        $this->country = $dto->country;
        $this->employeeNumber = $dto->employeeNumber;
        $this->creditLimit = $dto->creditLimit;
    }

    public function getCustomerNumber(): int
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(int $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function getContactLastName(): string
    {
        return $this->contactLastName;
    }

    public function setContactLastName(string $contactLastName): void
    {
        $this->contactLastName = $contactLastName;
    }

    public function getContactFirstName(): string
    {
        return $this->contactFirstName;
    }

    public function setContactFirstName(string $contactFirstName): void
    {
        $this->contactFirstName = $contactFirstName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(string $addressLine1): void
    {
        $this->addressLine1 = $addressLine1;
    }

    public function getAddressLine2(): string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(string $addressLine2): void
    {
        $this->addressLine2 = $addressLine2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getEmployeeNumber(): int
    {
        return $this->employeeNumber;
    }

    public function setEmployeeNumber(int $employeeNumber): void
    {
        $this->employeeNumber = $employeeNumber;
    }

    public function getCreditLimit(): float
    {
        return $this->creditLimit;
    }

    public function setCreditLimit(float $creditLimit): void
    {
        $this->creditLimit = $creditLimit;
    }

    public function toDto(): CustomersDto
    {
        $dto = new CustomersDto();
        $dto->customerNumber = (int) ($this->customerNumber ?? 0);
        $dto->customerName = $this->customerName ?? "";
        $dto->contactLastName = $this->contactLastName ?? "";
        $dto->contactFirstName = $this->contactFirstName ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->addressLine1 = $this->addressLine1 ?? "";
        $dto->addressLine2 = $this->addressLine2 ?? "";
        $dto->city = $this->city ?? "";
        $dto->state = $this->state ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->country = $this->country ?? "";
        $dto->employeeNumber = (int) ($this->employeeNumber ?? 0);
        $dto->creditLimit = (float) ($this->creditLimit ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "customer_number" => $this->customerNumber,
            "customer_name" => $this->customerName,
            "contact_last_name" => $this->contactLastName,
            "contact_first_name" => $this->contactFirstName,
            "phone" => $this->phone,
            "address_line1" => $this->addressLine1,
            "address_line2" => $this->addressLine2,
            "city" => $this->city,
            "state" => $this->state,
            "postal_code" => $this->postalCode,
            "country" => $this->country,
            "employee_number" => $this->employeeNumber,
            "credit_limit" => $this->creditLimit,
        ];
    }
}