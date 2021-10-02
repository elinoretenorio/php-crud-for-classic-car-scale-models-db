<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

class EmployeesDto 
{
    public int $employeeNumber;
    public string $lastName;
    public string $firstName;
    public string $extension;
    public string $email;
    public string $officeCode;
    public int $reportsTo;
    public string $jobTitle;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->employeeNumber = (int) ($row["employee_number"] ?? 0);
        $this->lastName = $row["last_name"] ?? "";
        $this->firstName = $row["first_name"] ?? "";
        $this->extension = $row["extension"] ?? "";
        $this->email = $row["email"] ?? "";
        $this->officeCode = $row["office_code"] ?? "";
        $this->reportsTo = (int) ($row["reports_to"] ?? 0);
        $this->jobTitle = $row["job_title"] ?? "";
    }
}