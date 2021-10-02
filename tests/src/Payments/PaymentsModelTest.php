<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Payments;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Payments\{ PaymentsDto, PaymentsModel };

class PaymentsModelTest extends TestCase
{
    private array $input;
    private PaymentsDto $dto;
    private PaymentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "payment_number" => 4402,
            "customer_number" => 7298,
            "check_number" => "production",
            "payment_date" => "2021-09-29",
            "amount" => 56.00,
        ];
        $this->dto = new PaymentsDto($this->input);
        $this->model = new PaymentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PaymentsModel(null);

        $this->assertInstanceOf(PaymentsModel::class, $model);
    }

    public function testGetPaymentNumber(): void
    {
        $this->assertEquals($this->dto->paymentNumber, $this->model->getPaymentNumber());
    }

    public function testSetPaymentNumber(): void
    {
        $expected = 5200;
        $model = $this->model;
        $model->setPaymentNumber($expected);

        $this->assertEquals($expected, $model->getPaymentNumber());
    }

    public function testGetCustomerNumber(): void
    {
        $this->assertEquals($this->dto->customerNumber, $this->model->getCustomerNumber());
    }

    public function testSetCustomerNumber(): void
    {
        $expected = 8461;
        $model = $this->model;
        $model->setCustomerNumber($expected);

        $this->assertEquals($expected, $model->getCustomerNumber());
    }

    public function testGetCheckNumber(): void
    {
        $this->assertEquals($this->dto->checkNumber, $this->model->getCheckNumber());
    }

    public function testSetCheckNumber(): void
    {
        $expected = "reason";
        $model = $this->model;
        $model->setCheckNumber($expected);

        $this->assertEquals($expected, $model->getCheckNumber());
    }

    public function testGetPaymentDate(): void
    {
        $this->assertEquals($this->dto->paymentDate, $this->model->getPaymentDate());
    }

    public function testSetPaymentDate(): void
    {
        $expected = "2021-09-23";
        $model = $this->model;
        $model->setPaymentDate($expected);

        $this->assertEquals($expected, $model->getPaymentDate());
    }

    public function testGetAmount(): void
    {
        $this->assertEquals($this->dto->amount, $this->model->getAmount());
    }

    public function testSetAmount(): void
    {
        $expected = 881.55;
        $model = $this->model;
        $model->setAmount($expected);

        $this->assertEquals($expected, $model->getAmount());
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