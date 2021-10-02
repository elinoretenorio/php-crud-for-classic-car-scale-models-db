<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Products;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Products\{ ProductsDto, ProductsModel, IProductsService, ProductsService };

class ProductsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ProductsDto $dto;
    private ProductsModel $model;
    private IProductsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Products\IProductsRepository");
        $this->input = [
            "product_number" => 9785,
            "product_code" => "high",
            "product_name" => "wrong",
            "product_line" => "easy",
            "product_scale" => "usually",
            "product_vendor" => "each",
            "product_description" => "Soldier city together although issue everything. Throw education school thus serve against.",
            "quantity_in_stock" => 9146,
            "buy_price" => 147.00,
            "msrp" => 101.57,
        ];
        $this->dto = new ProductsDto($this->input);
        $this->model = new ProductsModel($this->dto);
        $this->service = new ProductsService($this->repository);
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
        $expected = 7244;

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
        $expected = 7780;

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
        $productNumber = 1224;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productNumber)
            ->willReturn(null);

        $actual = $this->service->get($productNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $productNumber = 1982;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($productNumber);
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
        $productNumber = 4455;
        $expected = 3398;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($productNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($productNumber);
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