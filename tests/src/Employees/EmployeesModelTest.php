<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Employees;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Employees\{ EmployeesDto, EmployeesModel };

class EmployeesModelTest extends TestCase
{
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "employee_number" => 8085,
            "last_name" => "we",
            "first_name" => "why",
            "extension" => "region",
            "email" => "robert80@example.org",
            "office_code" => "much",
            "reports_to" => 993,
            "job_title" => "but",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new EmployeesModel(null);

        $this->assertInstanceOf(EmployeesModel::class, $model);
    }

    public function testGetEmployeeNumber(): void
    {
        $this->assertEquals($this->dto->employeeNumber, $this->model->getEmployeeNumber());
    }

    public function testSetEmployeeNumber(): void
    {
        $expected = 4146;
        $model = $this->model;
        $model->setEmployeeNumber($expected);

        $this->assertEquals($expected, $model->getEmployeeNumber());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "amount";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "course";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetExtension(): void
    {
        $this->assertEquals($this->dto->extension, $this->model->getExtension());
    }

    public function testSetExtension(): void
    {
        $expected = "manager";
        $model = $this->model;
        $model->setExtension($expected);

        $this->assertEquals($expected, $model->getExtension());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->dto->email, $this->model->getEmail());
    }

    public function testSetEmail(): void
    {
        $expected = "zfowler@example.net";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
    }

    public function testGetOfficeCode(): void
    {
        $this->assertEquals($this->dto->officeCode, $this->model->getOfficeCode());
    }

    public function testSetOfficeCode(): void
    {
        $expected = "whatever";
        $model = $this->model;
        $model->setOfficeCode($expected);

        $this->assertEquals($expected, $model->getOfficeCode());
    }

    public function testGetReportsTo(): void
    {
        $this->assertEquals($this->dto->reportsTo, $this->model->getReportsTo());
    }

    public function testSetReportsTo(): void
    {
        $expected = 5367;
        $model = $this->model;
        $model->setReportsTo($expected);

        $this->assertEquals($expected, $model->getReportsTo());
    }

    public function testGetJobTitle(): void
    {
        $this->assertEquals($this->dto->jobTitle, $this->model->getJobTitle());
    }

    public function testSetJobTitle(): void
    {
        $expected = "ok";
        $model = $this->model;
        $model->setJobTitle($expected);

        $this->assertEquals($expected, $model->getJobTitle());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}