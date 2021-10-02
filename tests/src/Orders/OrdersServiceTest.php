<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Orders;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Orders\{ OrdersDto, OrdersModel, IOrdersService, OrdersService };

class OrdersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;
    private IOrdersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Orders\IOrdersRepository");
        $this->input = [
            "order_number" => 3253,
            "order_date" => "2021-10-11",
            "required_date" => "2021-09-27",
            "shipped_date" => "2021-09-21",
            "status" => "tree",
            "comments" => "Artist sometimes story first group watch. Unit hour husband strong respond back change. Town music must discuss program.",
            "customer_number" => 7536,
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
        $this->service = new OrdersService($this->repository);
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
        $expected = 6838;

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
        $expected = 1133;

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
        $orderNumber = 3155;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderNumber)
            ->willReturn(null);

        $actual = $this->service->get($orderNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $orderNumber = 1750;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($orderNumber);
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
        $orderNumber = 9009;
        $expected = 7487;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($orderNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($orderNumber);
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