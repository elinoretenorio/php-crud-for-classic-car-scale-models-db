<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\OrderDetails\{ OrderDetailsDto, OrderDetailsModel, IOrderDetailsService, OrderDetailsService };

class OrderDetailsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private OrderDetailsDto $dto;
    private OrderDetailsModel $model;
    private IOrderDetailsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\OrderDetails\IOrderDetailsRepository");
        $this->input = [
            "order_detail_number" => 4578,
            "order_number" => 5682,
            "product_code" => "friend",
            "quantity_ordered" => 15,
            "price_each" => 234.35,
            "order_line_number" => 8608,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->model = new OrderDetailsModel($this->dto);
        $this->service = new OrderDetailsService($this->repository);
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
        $expected = 9699;

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
        $expected = 5891;

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
        $orderDetailNumber = 7213;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderDetailNumber)
            ->willReturn(null);

        $actual = $this->service->get($orderDetailNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $orderDetailNumber = 6498;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderDetailNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($orderDetailNumber);
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
        $orderDetailNumber = 7863;
        $expected = 260;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($orderDetailNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($orderDetailNumber);
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