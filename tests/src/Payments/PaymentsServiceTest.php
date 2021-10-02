<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Payments;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Payments\{ PaymentsDto, PaymentsModel, IPaymentsService, PaymentsService };

class PaymentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PaymentsDto $dto;
    private PaymentsModel $model;
    private IPaymentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Payments\IPaymentsRepository");
        $this->input = [
            "payment_number" => 1052,
            "customer_number" => 4597,
            "check_number" => "reduce",
            "payment_date" => "2021-10-04",
            "amount" => 913.36,
        ];
        $this->dto = new PaymentsDto($this->input);
        $this->model = new PaymentsModel($this->dto);
        $this->service = new PaymentsService($this->repository);
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
        $expected = 7417;

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
        $expected = 7438;

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
        $paymentNumber = 2553;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($paymentNumber)
            ->willReturn(null);

        $actual = $this->service->get($paymentNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $paymentNumber = 95;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($paymentNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($paymentNumber);
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
        $paymentNumber = 823;
        $expected = 7930;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($paymentNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($paymentNumber);
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