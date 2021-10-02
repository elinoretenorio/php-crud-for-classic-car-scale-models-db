<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Customers;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Customers\{ CustomersDto, CustomersModel, ICustomersService, CustomersService };

class CustomersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomersDto $dto;
    private CustomersModel $model;
    private ICustomersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Customers\ICustomersRepository");
        $this->input = [
            "customer_number" => 5139,
            "customer_name" => "herself",
            "contact_last_name" => "national",
            "contact_first_name" => "animal",
            "phone" => "certainly",
            "address_line1" => "like",
            "address_line2" => "money",
            "city" => "pay",
            "state" => "evening",
            "postal_code" => "open",
            "country" => "increase",
            "employee_number" => 4511,
            "credit_limit" => 370.30,
        ];
        $this->dto = new CustomersDto($this->input);
        $this->model = new CustomersModel($this->dto);
        $this->service = new CustomersService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 3455;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 7734;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $customerNumber = 5266;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerNumber)
            ->willReturn(null);

        $actual = $this->service->get($customerNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerNumber = 3334;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerNumber);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerNumber = 4848;
        $expected = 1841;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($customerNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}