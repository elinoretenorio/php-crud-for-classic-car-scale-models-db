<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Orders;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Orders\{ OrdersDto, OrdersModel };

class OrdersModelTest extends TestCase
{
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "order_number" => 4112,
            "order_date" => "2021-10-13",
            "required_date" => "2021-09-21",
            "shipped_date" => "2021-10-05",
            "status" => "move",
            "comments" => "Card threat article tend employee on nor during. Information charge half mission only.",
            "customer_number" => 4846,
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new OrdersModel(null);

        $this->assertInstanceOf(OrdersModel::class, $model);
    }

    public function testGetOrderNumber(): void
    {
        $this->assertEquals($this->dto->orderNumber, $this->model->getOrderNumber());
    }

    public function testSetOrderNumber(): void
    {
        $expected = 2034;
        $model = $this->model;
        $model->setOrderNumber($expected);

        $this->assertEquals($expected, $model->getOrderNumber());
    }

    public function testGetOrderDate(): void
    {
        $this->assertEquals($this->dto->orderDate, $this->model->getOrderDate());
    }

    public function testSetOrderDate(): void
    {
        $expected = "2021-09-18";
        $model = $this->model;
        $model->setOrderDate($expected);

        $this->assertEquals($expected, $model->getOrderDate());
    }

    public function testGetRequiredDate(): void
    {
        $this->assertEquals($this->dto->requiredDate, $this->model->getRequiredDate());
    }

    public function testSetRequiredDate(): void
    {
        $expected = "2021-09-27";
        $model = $this->model;
        $model->setRequiredDate($expected);

        $this->assertEquals($expected, $model->getRequiredDate());
    }

    public function testGetShippedDate(): void
    {
        $this->assertEquals($this->dto->shippedDate, $this->model->getShippedDate());
    }

    public function testSetShippedDate(): void
    {
        $expected = "2021-09-18";
        $model = $this->model;
        $model->setShippedDate($expected);

        $this->assertEquals($expected, $model->getShippedDate());
    }

    public function testGetStatus(): void
    {
        $this->assertEquals($this->dto->status, $this->model->getStatus());
    }

    public function testSetStatus(): void
    {
        $expected = "person";
        $model = $this->model;
        $model->setStatus($expected);

        $this->assertEquals($expected, $model->getStatus());
    }

    public function testGetComments(): void
    {
        $this->assertEquals($this->dto->comments, $this->model->getComments());
    }

    public function testSetComments(): void
    {
        $expected = "Certain important specific let her. A want book commercial moment. Guy describe force.";
        $model = $this->model;
        $model->setComments($expected);

        $this->assertEquals($expected, $model->getComments());
    }

    public function testGetCustomerNumber(): void
    {
        $this->assertEquals($this->dto->customerNumber, $this->model->getCustomerNumber());
    }

    public function testSetCustomerNumber(): void
    {
        $expected = 9354;
        $model = $this->model;
        $model->setCustomerNumber($expected);

        $this->assertEquals($expected, $model->getCustomerNumber());
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