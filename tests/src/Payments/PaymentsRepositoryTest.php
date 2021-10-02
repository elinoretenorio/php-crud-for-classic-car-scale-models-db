<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Payments;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Payments\{ PaymentsDto, IPaymentsRepository, PaymentsRepository };

class PaymentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private PaymentsDto $dto;
    private IPaymentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "payment_number" => 1835,
            "customer_number" => 4002,
            "check_number" => "of",
            "payment_date" => "2021-10-08",
            "amount" => 982.00,
        ];
        $this->dto = new PaymentsDto($this->input);
        $this->repository = new PaymentsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 1993;

        $sql = "INSERT INTO `payments` (`customer_number`, `check_number`, `payment_date`, `amount`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerNumber,
                $this->dto->checkNumber,
                $this->dto->paymentDate,
                $this->dto->amount
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 7044;

        $sql = "UPDATE `payments` SET `customer_number` = ?, `check_number` = ?, `payment_date` = ?, `amount` = ?
                WHERE `payment_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerNumber,
                $this->dto->checkNumber,
                $this->dto->paymentDate,
                $this->dto->amount,
                $this->dto->paymentNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $paymentNumber = 2882;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($paymentNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $paymentNumber = 3807;

        $sql = "SELECT `payment_number`, `customer_number`, `check_number`, `payment_date`, `amount`
                FROM `payments` WHERE `payment_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$paymentNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($paymentNumber);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `payment_number`, `customer_number`, `check_number`, `payment_date`, `amount`
                FROM `payments`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $paymentNumber = 6865;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($paymentNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $paymentNumber = 4432;
        $expected = 8712;

        $sql = "DELETE FROM `payments` WHERE `payment_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$paymentNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($paymentNumber);
        $this->assertEquals($expected, $actual);
    }
}