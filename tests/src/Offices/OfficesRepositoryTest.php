<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Offices;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Offices\{ OfficesDto, IOfficesRepository, OfficesRepository };

class OfficesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private OfficesDto $dto;
    private IOfficesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "office_number" => 199,
            "office_code" => "see",
            "city" => "ground",
            "phone" => "group",
            "address_line1" => "produce",
            "address_line2" => "possible",
            "state" => "go",
            "country" => "reason",
            "postal_code" => "compare",
            "territory" => "network",
        ];
        $this->dto = new OfficesDto($this->input);
        $this->repository = new OfficesRepository($this->db);
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
        $expected = 1035;

        $sql = "INSERT INTO `offices` (`office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->officeCode,
                $this->dto->city,
                $this->dto->phone,
                $this->dto->addressLine1,
                $this->dto->addressLine2,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->territory
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
        $expected = 2827;

        $sql = "UPDATE `offices` SET `office_code` = ?, `city` = ?, `phone` = ?, `address_line1` = ?, `address_line2` = ?, `state` = ?, `country` = ?, `postal_code` = ?, `territory` = ?
                WHERE `office_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->officeCode,
                $this->dto->city,
                $this->dto->phone,
                $this->dto->addressLine1,
                $this->dto->addressLine2,
                $this->dto->state,
                $this->dto->country,
                $this->dto->postalCode,
                $this->dto->territory,
                $this->dto->officeNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $officeNumber = 7128;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($officeNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $officeNumber = 3041;

        $sql = "SELECT `office_number`, `office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`
                FROM `offices` WHERE `office_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$officeNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($officeNumber);
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
        $sql = "SELECT `office_number`, `office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`
                FROM `offices`";

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
        $officeNumber = 8732;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($officeNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $officeNumber = 7912;
        $expected = 6558;

        $sql = "DELETE FROM `offices` WHERE `office_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$officeNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($officeNumber);
        $this->assertEquals($expected, $actual);
    }
}