<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Employees;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Employees\{ EmployeesDto, EmployeesModel, IEmployeesService, EmployeesService };

class EmployeesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;
    private IEmployeesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Employees\IEmployeesRepository");
        $this->input = [
            "employee_number" => 9101,
            "last_name" => "data",
            "first_name" => "piece",
            "extension" => "kitchen",
            "email" => "gregory37@example.org",
            "office_code" => "hot",
            "reports_to" => 8798,
            "job_title" => "effect",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
        $this->service = new EmployeesService($this->repository);
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
        $expected = 1861;

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
        $expected = 3350;

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
        $employeeNumber = 1797;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeNumber)
            ->willReturn(null);

        $actual = $this->service->get($employeeNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $employeeNumber = 6000;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($employeeNumber);
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
        $employeeNumber = 25;
        $expected = 5146;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($employeeNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($employeeNumber);
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