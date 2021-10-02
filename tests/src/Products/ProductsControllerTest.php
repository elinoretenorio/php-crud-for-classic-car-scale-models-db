<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Products;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Products\{ ProductsDto, ProductsModel, ProductsController };

class ProductsControllerTest extends TestCase
{
    private array $input;
    private ProductsDto $dto;
    private ProductsModel $model;
    private $service;
    private $request;
    private $stream;
    private ProductsController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "product_number" => 4930,
            "product_code" => "eye",
            "product_name" => "would",
            "product_line" => "send",
            "product_scale" => "book",
            "product_vendor" => "century",
            "product_description" => "East method huge local community new. Take close himself seven week off.",
            "quantity_in_stock" => 4370,
            "buy_price" => 597.46,
            "msrp" => 469.30,
        ];
        $this->dto = new ProductsDto($this->input);
        $this->model = new ProductsModel($this->dto);
        $this->service = $this->createMock("ClassicCarScaleModels\Products\IProductsService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new ProductsController(
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
        $id = 5919;
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
        $args = ["product_number" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 8363;
        $expected = ["result" => $id];
        $args = ["product_number" => 1812];

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
        $args = ["product_number" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["product_number" => 5898];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["product_number"])
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
        $args = ["product_number" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 5579;
        $expected = ["result" => $id];
        $args = ["product_number" => 3664];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["product_number"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}