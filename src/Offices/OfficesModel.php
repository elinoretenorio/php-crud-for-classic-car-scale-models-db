<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

use JsonSerializable;

class OfficesModel implements JsonSerializable
{
    private int $officeNumber;
    private string $officeCode;
    private string $city;
    private string $phone;
    private string $addressLine1;
    private string $addressLine2;
    private string $state;
    private string $country;
    private string $postalCode;
    private string $territory;

    public function __construct(OfficesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->officeNumber = $dto->officeNumber;
        $this->officeCode = $dto->officeCode;
        $this->city = $dto->city;
        $this->phone = $dto->phone;
        $this->addressLine1 = $dto->addressLine1;
        $this->addressLine2 = $dto->addressLine2;
        $this->state = $dto->state;
        $this->country = $dto->country;
        $this->postalCode = $dto->postalCode;
        $this->territory = $dto->territory;
    }

    public function getOfficeNumber(): int
    {
        return $this->officeNumber;
    }

    public function setOfficeNumber(int $officeNumber): void
    {
        $this->officeNumber = $officeNumber;
    }

    public function getOfficeCode(): string
    {
        return $this->officeCode;
    }

    public function setOfficeCode(string $officeCode): void
    {
        $this->officeCode = $officeCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
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

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getTerritory(): string
    {
        return $this->territory;
    }

    public function setTerritory(string $territory): void
    {
        $this->territory = $territory;
    }

    public function toDto(): OfficesDto
    {
        $dto = new OfficesDto();
        $dto->officeNumber = (int) ($this->officeNumber ?? 0);
        $dto->officeCode = $this->officeCode ?? "";
        $dto->city = $this->city ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->addressLine1 = $this->addressLine1 ?? "";
        $dto->addressLine2 = $this->addressLine2 ?? "";
        $dto->state = $this->state ?? "";
        $dto->country = $this->country ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->territory = $this->territory ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "office_number" => $this->officeNumber,
            "office_code" => $this->officeCode,
            "city" => $this->city,
            "phone" => $this->phone,
            "address_line1" => $this->addressLine1,
            "address_line2" => $this->addressLine2,
            "state" => $this->state,
            "country" => $this->country,
            "postal_code" => $this->postalCode,
            "territory" => $this->territory,
        ];
    }
}