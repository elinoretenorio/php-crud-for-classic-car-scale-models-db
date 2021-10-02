<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\OrderDetails\{ OrderDetailsDto, OrderDetailsModel };

class OrderDetailsModelTest extends TestCase
{
    private array $input;
    private OrderDetailsDto $dto;
    private OrderDetailsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "order_detail_number" => 2432,
            "order_number" => 1734,
            "product_code" => "be",
            "quantity_ordered" => 5601,
            "price_each" => 174.87,
            "order_line_number" => 3268,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->model = new OrderDetailsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new OrderDetailsModel(null);

        $this->assertInstanceOf(OrderDetailsModel::class, $model);
    }

    public function testGetOrderDetailNumber(): void
    {
        $this->assertEquals($this->dto->orderDetailNumber, $this->model->getOrderDetailNumber());
    }

    public function testSetOrderDetailNumber(): void
    {
        $expected = 3067;
        $model = $this->model;
        $model->setOrderDetailNumber($expected);

        $this->assertEquals($expected, $model->getOrderDetailNumber());
    }

    public function testGetOrderNumber(): void
    {
        $this->assertEquals($this->dto->orderNumber, $this->model->getOrderNumber());
    }

    public function testSetOrderNumber(): void
    {
        $expected = 1857;
        $model = $this->model;
        $model->setOrderNumber($expected);

        $this->assertEquals($expected, $model->getOrderNumber());
    }

    public function testGetProductCode(): void
    {
        $this->assertEquals($this->dto->productCode, $this->model->getProductCode());
    }

    public function testSetProductCode(): void
    {
        $expected = "eye";
        $model = $this->model;
        $model->setProductCode($expected);

        $this->assertEquals($expected, $model->getProductCode());
    }

    public function testGetQuantityOrdered(): void
    {
        $this->assertEquals($this->dto->quantityOrdered, $this->model->getQuantityOrdered());
    }

    public function testSetQuantityOrdered(): void
    {
        $expected = 3653;
        $model = $this->model;
        $model->setQuantityOrdered($expected);

        $this->assertEquals($expected, $model->getQuantityOrdered());
    }

    public function testGetPriceEach(): void
    {
        $this->assertEquals($this->dto->priceEach, $this->model->getPriceEach());
    }

    public function testSetPriceEach(): void
    {
        $expected = 346.20;
        $model = $this->model;
        $model->setPriceEach($expected);

        $this->assertEquals($expected, $model->getPriceEach());
    }

    public function testGetOrderLineNumber(): void
    {
        $this->assertEquals($this->dto->orderLineNumber, $this->model->getOrderLineNumber());
    }

    public function testSetOrderLineNumber(): void
    {
        $expected = 7404;
        $model = $this->model;
        $model->setOrderLineNumber($expected);

        $this->assertEquals($expected, $model->getOrderLineNumber());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}