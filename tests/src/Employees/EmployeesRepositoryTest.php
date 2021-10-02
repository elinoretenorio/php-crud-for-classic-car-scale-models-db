<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Employees;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Database\DatabaseException;
use ClassicCarScaleModels\Employees\{ EmployeesDto, IEmployeesRepository, EmployeesRepository };

class EmployeesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private EmployeesDto $dto;
    private IEmployeesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("ClassicCarScaleModels\Database\IDatabase");
        $this->result = $this->createMock("ClassicCarScaleModels\Database\IDatabaseResult");
        $this->input = [
            "employee_number" => 3454,
            "last_name" => "involve",
            "first_name" => "program",
            "extension" => "lawyer",
            "email" => "matthewmcmahon@example.com",
            "office_code" => "student",
            "reports_to" => 7035,
            "job_title" => "foreign",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->repository = new EmployeesRepository($this->db);
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
        $expected = 3420;

        $sql = "INSERT INTO `employees` (`last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->extension,
                $this->dto->email,
                $this->dto->officeCode,
                $this->dto->reportsTo,
                $this->dto->jobTitle
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
        $expected = 8917;

        $sql = "UPDATE `employees` SET `last_name` = ?, `first_name` = ?, `extension` = ?, `email` = ?, `office_code` = ?, `reports_to` = ?, `job_title` = ?
                WHERE `employee_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->extension,
                $this->dto->email,
                $this->dto->officeCode,
                $this->dto->reportsTo,
                $this->dto->jobTitle,
                $this->dto->employeeNumber
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $employeeNumber = 6914;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($employeeNumber);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $employeeNumber = 7896;

        $sql = "SELECT `employee_number`, `last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`
                FROM `employees` WHERE `employee_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeNumber]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($employeeNumber);
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
        $sql = "SELECT `employee_number`, `last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`
                FROM `employees`";

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
        $employeeNumber = 3289;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($employeeNumber);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeNumber = 964;
        $expected = 6952;

        $sql = "DELETE FROM `employees` WHERE `employee_number` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeNumber]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($employeeNumber);
        $this->assertEquals($expected, $actual);
    }
}