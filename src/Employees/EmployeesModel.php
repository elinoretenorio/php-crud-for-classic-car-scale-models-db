<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

use JsonSerializable;

class EmployeesModel implements JsonSerializable
{
    private int $employeeNumber;
    private string $lastName;
    private string $firstName;
    private string $extension;
    private string $email;
    private string $officeCode;
    private int $reportsTo;
    private string $jobTitle;

    public function __construct(EmployeesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->employeeNumber = $dto->employeeNumber;
        $this->lastName = $dto->lastName;
        $this->firstName = $dto->firstName;
        $this->extension = $dto->extension;
        $this->email = $dto->email;
        $this->officeCode = $dto->officeCode;
        $this->reportsTo = $dto->reportsTo;
        $this->jobTitle = $dto->jobTitle;
    }

    public function getEmployeeNumber(): int
    {
        return $this->employeeNumber;
    }

    public function setEmployeeNumber(int $employeeNumber): void
    {
        $this->employeeNumber = $employeeNumber;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getOfficeCode(): string
    {
        return $this->officeCode;
    }

    public function setOfficeCode(string $officeCode): void
    {
        $this->officeCode = $officeCode;
    }

    public function getReportsTo(): int
    {
        return $this->reportsTo;
    }

    public function setReportsTo(int $reportsTo): void
    {
        $this->reportsTo = $reportsTo;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function toDto(): EmployeesDto
    {
        $dto = new EmployeesDto();
        $dto->employeeNumber = (int) ($this->employeeNumber ?? 0);
        $dto->lastName = $this->lastName ?? "";
        $dto->firstName = $this->firstName ?? "";
        $dto->extension = $this->extension ?? "";
        $dto->email = $this->email ?? "";
        $dto->officeCode = $this->officeCode ?? "";
        $dto->reportsTo = (int) ($this->reportsTo ?? 0);
        $dto->jobTitle = $this->jobTitle ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "employee_number" => $this->employeeNumber,
            "last_name" => $this->lastName,
            "first_name" => $this->firstName,
            "extension" => $this->extension,
            "email" => $this->email,
            "office_code" => $this->officeCode,
            "reports_to" => $this->reportsTo,
            "job_title" => $this->jobTitle,
        ];
    }
}