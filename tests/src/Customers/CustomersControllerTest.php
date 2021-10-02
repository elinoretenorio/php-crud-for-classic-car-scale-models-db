<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Customers;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Customers\{ CustomersDto, CustomersModel, CustomersController };

class CustomersControllerTest extends TestCase
{
    private array $input;
    private CustomersDto $dto;
    private CustomersModel $model;
    private $service;
    private $request;
    private $stream;
    private CustomersController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "customer_number" => 9,
            "customer_name" => "reason",
            "contact_last_name" => "future",
            "contact_first_name" => "home",
            "phone" => "girl",
            "address_line1" => "her",
            "address_line2" => "sometimes",
            "city" => "water",
            "state" => "event",
            "postal_code" => "ready",
            "country" => "daughter",
            "employee_number" => 5036,
            "credit_limit" => 344.37,
        ];
        $this->dto = new CustomersDto($this->input);
        $this->model = new CustomersModel($this->dto);
        $this->service = $this->createMock("ClassicCarScaleModels\Customers\ICustomersService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new CustomersController(
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
        $id = 3252;
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
        $args = ["customer_number" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 4771;
        $expected = ["result" => $id];
        $args = ["customer_number" => 6454];

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
        $args = ["customer_number" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["customer_number" => 6564];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["customer_number"])
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
        $args = ["customer_number" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 5463;
        $expected = ["result" => $id];
        $args = ["customer_number" => 2883];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["customer_number"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}