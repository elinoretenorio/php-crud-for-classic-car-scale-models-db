<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Customers;

class CustomersDto 
{
    public int $customerNumber;
    public string $customerName;
    public string $contactLastName;
    public string $contactFirstName;
    public string $phone;
    public string $addressLine1;
    public string $addressLine2;
    public string $city;
    public string $state;
    public string $postalCode;
    public string $country;
    public int $employeeNumber;
    public float $creditLimit;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerNumber = (int) ($row["customer_number"] ?? 0);
        $this->customerName = $row["customer_name"] ?? "";
        $this->contactLastName = $row["contact_last_name"] ?? "";
        $this->contactFirstName = $row["contact_first_name"] ?? "";
        $this->phone = $row["phone"] ?? "";
        $this->addressLine1 = $row["address_line1"] ?? "";
        $this->addressLine2 = $row["address_line2"] ?? "";
        $this->city = $row["city"] ?? "";
        $this->state = $row["state"] ?? "";
        $this->postalCode = $row["postal_code"] ?? "";
        $this->country = $row["country"] ?? "";
        $this->employeeNumber = (int) ($row["employee_number"] ?? 0);
        $this->creditLimit = (float) ($row["credit_limit"] ?? 0);
    }
}