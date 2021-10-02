<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Customers;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Customers\{ CustomersDto, ICustomersRepository, CustomersRepository };

class CustomersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CustomersDto $dto;
    private ICustomersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "customer_number" => 1404,
            "customer_name" => "real",
            "contact_last_name" => "across",
            "contact_first_name" => "center",
            "phone" => "cultural",
            "address_line1" => "performance",
            "address_line2" => "current",
            "city" => "still",
            "state" => "cell",
            "postal_code" => "speech",
            "country" => "third",
            "employee_number" => 898,
            "credit_limit" => 103.12,
        ];
        $this->dto = new CustomersDto($this->input);
        $this->repository = new CustomersRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 6684;

        $sql = "INSERT INTO `customers` (`customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerName,
                $this->dto->contactLastName,
                $this->dto->contactFirstName,
                $this->dto->phone,
                $this->dto->addressLine1,
                $this->dto->addressLine2,
                $this->dto->city,
                $this->dto->state,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->employeeNumber,
                $this->dto->creditLimit
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 1594;

        $sql = "UPDATE `customers` SET `customer_name` = ?, `contact_last_name` = ?, `contact_first_name` = ?, `phone` = ?, `address_line1` = ?, `address_line2` = ?, `city` = ?, `state` = ?, `postal_code` = ?, `country` = ?, `employee_number` = ?, `credit_limit` = ?
                WHERE `customer_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerName,
                $this->dto->contactLastName,
                $this->dto->contactFirstName,
                $this->dto->phone,
                $this->dto->addressLine1,
                $this->dto->addressLine2,
                $this->dto->city,
                $this->dto->state,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->employeeNumber,
                $this->dto->creditLimit,
                $this->dto->customerNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customerNumber = 1417;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customerNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customerNumber = 2176;

        $sql = "SELECT `customer_number`, `customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`
                FROM `customers` WHERE `customer_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customerNumber);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `customer_number`, `customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`
                FROM `customers`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $customerNumber = 1639;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customerNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerNumber = 605;
        $expected = 6359;

        $sql = "DELETE FROM `customers` WHERE `customer_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customerNumber);
        $this->assertEquals($expected, $actual);
    }
}