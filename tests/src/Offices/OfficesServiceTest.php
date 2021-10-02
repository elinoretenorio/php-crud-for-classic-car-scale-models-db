<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Offices;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Offices\{ OfficesDto, OfficesModel, IOfficesService, OfficesService };

class OfficesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private OfficesDto $dto;
    private OfficesModel $model;
    private IOfficesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("ClassicCarScaleModels\Offices\IOfficesRepository");
        $this->input = [
            "office_number" => 4129,
            "office_code" => "quality",
            "city" => "true",
            "phone" => "treatment",
            "address_line1" => "miss",
            "address_line2" => "sound",
            "state" => "morning",
            "country" => "voice",
            "postal_code" => "course",
            "territory" => "summer",
        ];
        $this->dto = new OfficesDto($this->input);
        $this->model = new OfficesModel($this->dto);
        $this->service = new OfficesService($this->repository);
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
        $expected = 9971;

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
        $expected = 7837;

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
        $officeNumber = 2217;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($officeNumber)
            ->willReturn(null);

        $actual = $this->service->get($officeNumber);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $officeNumber = 8422;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($officeNumber)
            ->willReturn($this->dto);

        $actual = $this->service->get($officeNumber);
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
        $officeNumber = 4098;
        $expected = 4653;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($officeNumber)
            ->willReturn($expected);

        $actual = $this->service->delete($officeNumber);
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