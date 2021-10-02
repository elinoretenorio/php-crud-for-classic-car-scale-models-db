<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Customers;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Customers\{ CustomersDto, CustomersModel };

class CustomersModelTest extends TestCase
{
    private array $input;
    private CustomersDto $dto;
    private CustomersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "customer_number" => 5329,
            "customer_name" => "operation",
            "contact_last_name" => "movie",
            "contact_first_name" => "operation",
            "phone" => "including",
            "address_line1" => "central",
            "address_line2" => "let",
            "city" => "event",
            "state" => "thank",
            "postal_code" => "plant",
            "country" => "while",
            "employee_number" => 4091,
            "credit_limit" => 176.72,
        ];
        $this->dto = new CustomersDto($this->input);
        $this->model = new CustomersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomersModel(null);

        $this->assertInstanceOf(CustomersModel::class, $model);
    }

    public function testGetCustomerNumber(): void
    {
        $this->assertEquals($this->dto->customerNumber, $this->model->getCustomerNumber());
    }

    public function testSetCustomerNumber(): void
    {
        $expected = 4757;
        $model = $this->model;
        $model->setCustomerNumber($expected);

        $this->assertEquals($expected, $model->getCustomerNumber());
    }

    public function testGetCustomerName(): void
    {
        $this->assertEquals($this->dto->customerName, $this->model->getCustomerName());
    }

    public function testSetCustomerName(): void
    {
        $expected = "responsibility";
        $model = $this->model;
        $model->setCustomerName($expected);

        $this->assertEquals($expected, $model->getCustomerName());
    }

    public function testGetContactLastName(): void
    {
        $this->assertEquals($this->dto->contactLastName, $this->model->getContactLastName());
    }

    public function testSetContactLastName(): void
    {
        $expected = "central";
        $model = $this->model;
        $model->setContactLastName($expected);

        $this->assertEquals($expected, $model->getContactLastName());
    }

    public function testGetContactFirstName(): void
    {
        $this->assertEquals($this->dto->contactFirstName, $this->model->getContactFirstName());
    }

    public function testSetContactFirstName(): void
    {
        $expected = "at";
        $model = $this->model;
        $model->setContactFirstName($expected);

        $this->assertEquals($expected, $model->getContactFirstName());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "argue";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
    }

    public function testGetAddressLine1(): void
    {
        $this->assertEquals($this->dto->addressLine1, $this->model->getAddressLine1());
    }

    public function testSetAddressLine1(): void
    {
        $expected = "difference";
        $model = $this->model;
        $model->setAddressLine1($expected);

        $this->assertEquals($expected, $model->getAddressLine1());
    }

    public function testGetAddressLine2(): void
    {
        $this->assertEquals($this->dto->addressLine2, $this->model->getAddressLine2());
    }

    public function testSetAddressLine2(): void
    {
        $expected = "partner";
        $model = $this->model;
        $model->setAddressLine2($expected);

        $this->assertEquals($expected, $model->getAddressLine2());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "result";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetState(): void
    {
        $this->assertEquals($this->dto->state, $this->model->getState());
    }

    public function testSetState(): void
    {
        $expected = "history";
        $model = $this->model;
        $model->setState($expected);

        $this->assertEquals($expected, $model->getState());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "work";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetCountry(): void
    {
        $this->assertEquals($this->dto->country, $this->model->getCountry());
    }

    public function testSetCountry(): void
    {
        $expected = "behind";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetEmployeeNumber(): void
    {
        $this->assertEquals($this->dto->employeeNumber, $this->model->getEmployeeNumber());
    }

    public function testSetEmployeeNumber(): void
    {
        $expected = 2475;
        $model = $this->model;
        $model->setEmployeeNumber($expected);

        $this->assertEquals($expected, $model->getEmployeeNumber());
    }

    public function testGetCreditLimit(): void
    {
        $this->assertEquals($this->dto->creditLimit, $this->model->getCreditLimit());
    }

    public function testSetCreditLimit(): void
    {
        $expected = 371.00;
        $model = $this->model;
        $model->setCreditLimit($expected);

        $this->assertEquals($expected, $model->getCreditLimit());
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