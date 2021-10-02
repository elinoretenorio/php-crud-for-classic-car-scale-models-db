<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Orders;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Orders\{ OrdersDto, OrdersModel, OrdersController };

class OrdersControllerTest extends TestCase
{
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;
    private $service;
    private $request;
    private $stream;
    private OrdersController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "order_number" => 1273,
            "order_date" => "2021-09-19",
            "required_date" => "2021-09-19",
            "shipped_date" => "2021-09-22",
            "status" => "apply",
            "comments" => "Rich long culture nearly phone. Situation capital resource responsibility product ahead reach. Hear much someone magazine stop while first.",
            "customer_number" => 2028,
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
        $this->service = $this->createMock("ClassicCarScaleModels\Orders\IOrdersService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new OrdersController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 9956;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_number" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 2572;
        $expected = ["result" => $id];
        $args = ["order_number" => 9512];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_number" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["order_number" => 720];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["order_number"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_number" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 5562;
        $expected = ["result" => $id];
        $args = ["order_number" => 4383];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["order_number"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}