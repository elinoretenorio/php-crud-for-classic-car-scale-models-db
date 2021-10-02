<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

class OfficesDto 
{
    public int $officeNumber;
    public string $officeCode;
    public string $city;
    public string $phone;
    public string $addressLine1;
    public string $addressLine2;
    public string $state;
    public string $country;
    public string $postalCode;
    public string $territory;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->officeNumber = (int) ($row["office_number"] ?? 0);
        $this->officeCode = $row["office_code"] ?? "";
        $this->city = $row["city"] ?? "";
        $this->phone = $row["phone"] ?? "";
        $this->addressLine1 = $row["address_line1"] ?? "";
        $this->addressLine2 = $row["address_line2"] ?? "";
        $this->state = $row["state"] ?? "";
        $this->country = $row["country"] ?? "";
        $this->postalCode = $row["postal_code"] ?? "";
        $this->territory = $row["territory"] ?? "";
    }
}