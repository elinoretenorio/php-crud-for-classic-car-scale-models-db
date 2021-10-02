<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\OrderDetails\{ OrderDetailsDto, IOrderDetailsRepository, OrderDetailsRepository };

class OrderDetailsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private OrderDetailsDto $dto;
    private IOrderDetailsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "order_detail_number" => 5292,
            "order_number" => 3835,
            "product_code" => "series",
            "quantity_ordered" => 8011,
            "price_each" => 958.31,
            "order_line_number" => 3969,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->repository = new OrderDetailsRepository($this->db);
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
        $expected = 8669;

        $sql = "INSERT INTO `order_details` (`order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderNumber,
                $this->dto->productCode,
                $this->dto->quantityOrdered,
                $this->dto->priceEach,
                $this->dto->orderLineNumber
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
        $expected = 7942;

        $sql = "UPDATE `order_details` SET `order_number` = ?, `product_code` = ?, `quantity_ordered` = ?, `price_each` = ?, `order_line_number` = ?
                WHERE `order_detail_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderNumber,
                $this->dto->productCode,
                $this->dto->quantityOrdered,
                $this->dto->priceEach,
                $this->dto->orderLineNumber,
                $this->dto->orderDetailNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $orderDetailNumber = 9430;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($orderDetailNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $orderDetailNumber = 982;

        $sql = "SELECT `order_detail_number`, `order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`
                FROM `order_details` WHERE `order_detail_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderDetailNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($orderDetailNumber);
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
        $sql = "SELECT `order_detail_number`, `order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`
                FROM `order_details`";

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
        $orderDetailNumber = 8558;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($orderDetailNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $orderDetailNumber = 4211;
        $expected = 363;

        $sql = "DELETE FROM `order_details` WHERE `order_detail_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderDetailNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($orderDetailNumber);
        $this->assertEquals($expected, $actual);
    }
}