<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\ProductLines;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\ProductLines\{ ProductLinesDto, ProductLinesModel, IProductLinesService, ProductLinesService };

class ProductLinesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ProductLinesDto $dto;
    private ProductLinesModel $model;
    private IProductLinesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\ProductLines\IProductLinesRepository");
        $this->input = [
            "product_line_number" => 5478,
            "product_line" => "answer",
            "text_description" => "card",
            "html_description" => "Current past economic sign crime nothing. Can international friend. Back theory condition.",
            "image" => "Realize measure president design physical land.",
        ];
        $this->dto = new ProductLinesDto($this->input);
        $this->model = new ProductLinesModel($this->dto);
        $this->service = new ProductLinesService($this->repository);
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
        $expected = 275;

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
        $expected = 5550;

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
        $productLineNumber = 8953;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productLineNumber)
            ->willReturn(null);

        $actual = $this->service->get($productLineNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $productLineNumber = 8582;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productLineNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($productLineNumber);
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
        $productLineNumber = 3969;
        $expected = 941;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($productLineNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($productLineNumber);
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