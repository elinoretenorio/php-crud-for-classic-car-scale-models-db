<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Products;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Products\{ ProductsDto, IProductsRepository, ProductsRepository };

class ProductsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ProductsDto $dto;
    private IProductsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "product_number" => 1820,
            "product_code" => "cup",
            "product_name" => "your",
            "product_line" => "visit",
            "product_scale" => "war",
            "product_vendor" => "customer",
            "product_description" => "With painting analysis affect amount. Member of memory take clearly trouble. Near military human if study Democrat.",
            "quantity_in_stock" => 4359,
            "buy_price" => 970.00,
            "msrp" => 74.47,
        ];
        $this->dto = new ProductsDto($this->input);
        $this->repository = new ProductsRepository($this->db);
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
        $expected = 2766;

        $sql = "INSERT INTO `products` (`product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->productCode,
                $this->dto->productName,
                $this->dto->productLine,
                $this->dto->productScale,
                $this->dto->productVendor,
                $this->dto->productDescription,
                $this->dto->quantityInStock,
                $this->dto->buyPrice,
                $this->dto->msrp
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
        $expected = 7284;

        $sql = "UPDATE `products` SET `product_code` = ?, `product_name` = ?, `product_line` = ?, `product_scale` = ?, `product_vendor` = ?, `product_description` = ?, `quantity_in_stock` = ?, `buy_price` = ?, `msrp` = ?
                WHERE `product_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->productCode,
                $this->dto->productName,
                $this->dto->productLine,
                $this->dto->productScale,
                $this->dto->productVendor,
                $this->dto->productDescription,
                $this->dto->quantityInStock,
                $this->dto->buyPrice,
                $this->dto->msrp,
                $this->dto->productNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $productNumber = 1762;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($productNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $productNumber = 1259;

        $sql = "SELECT `product_number`, `product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`
                FROM `products` WHERE `product_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($productNumber);
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
        $sql = "SELECT `product_number`, `product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`
                FROM `products`";

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
        $productNumber = 5406;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($productNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productNumber = 4033;
        $expected = 8557;

        $sql = "DELETE FROM `products` WHERE `product_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($productNumber);
        $this->assertEquals($expected, $actual);
    }
}