<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Orders;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Orders\{ OrdersDto, IOrdersRepository, OrdersRepository };

class OrdersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private OrdersDto $dto;
    private IOrdersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "order_number" => 5439,
            "order_date" => "2021-09-19",
            "required_date" => "2021-10-03",
            "shipped_date" => "2021-09-21",
            "status" => "believe",
            "comments" => "Behavior wind court focus vote. Development late service reason direction live all hospital.",
            "customer_number" => 6592,
        ];
        $this->dto = new OrdersDto($this->input);
        $this->repository = new OrdersRepository($this->db);
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
        $expected = 1124;

        $sql = "INSERT INTO `orders` (`order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderDate,
                $this->dto->requiredDate,
                $this->dto->shippedDate,
                $this->dto->status,
                $this->dto->comments,
                $this->dto->customerNumber
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
        $expected = 8861;

        $sql = "UPDATE `orders` SET `order_date` = ?, `required_date` = ?, `shipped_date` = ?, `status` = ?, `comments` = ?, `customer_number` = ?
                WHERE `order_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderDate,
                $this->dto->requiredDate,
                $this->dto->shippedDate,
                $this->dto->status,
                $this->dto->comments,
                $this->dto->customerNumber,
                $this->dto->orderNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $orderNumber = 2741;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($orderNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $orderNumber = 8053;

        $sql = "SELECT `order_number`, `order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`
                FROM `orders` WHERE `order_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($orderNumber);
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
        $sql = "SELECT `order_number`, `order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`
                FROM `orders`";

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
        $orderNumber = 8266;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($orderNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $orderNumber = 9363;
        $expected = 4713;

        $sql = "DELETE FROM `orders` WHERE `order_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($orderNumber);
        $this->assertEquals($expected, $actual);
    }
}