<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Offices;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Offices\{ OfficesDto, OfficesModel };

class OfficesModelTest extends TestCase
{
    private array $input;
    private OfficesDto $dto;
    private OfficesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "office_number" => 8408,
            "office_code" => "discuss",
            "city" => "despite",
            "phone" => "let",
            "address_line1" => "care",
            "address_line2" => "business",
            "state" => "wear",
            "country" => "out",
            "postal_code" => "buy",
            "territory" => "remember",
        ];
        $this->dto = new OfficesDto($this->input);
        $this->model = new OfficesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new OfficesModel(null);

        $this->assertInstanceOf(OfficesModel::class, $model);
    }

    public function testGetOfficeNumber(): void
    {
        $this->assertEquals($this->dto->officeNumber, $this->model->getOfficeNumber());
    }

    public function testSetOfficeNumber(): void
    {
        $expected = 5807;
        $model = $this->model;
        $model->setOfficeNumber($expected);

        $this->assertEquals($expected, $model->getOfficeNumber());
    }

    public function testGetOfficeCode(): void
    {
        $this->assertEquals($this->dto->officeCode, $this->model->getOfficeCode());
    }

    public function testSetOfficeCode(): void
    {
        $expected = "firm";
        $model = $this->model;
        $model->setOfficeCode($expected);

        $this->assertEquals($expected, $model->getOfficeCode());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "base";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "theory";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
    }

    public function testGetAddressLine1(): void
    {
        $this->assertEquals($this->dto->addressLine1, $this->model->getAddressLine1());
    }

    public function testSetAddressLine1(): void
    {
        $expected = "no";
        $model = $this->model;
        $model->setAddressLine1($expected);

        $this->assertEquals($expected, $model->getAddressLine1());
    }

    public function testGetAddressLine2(): void
    {
        $this->assertEquals($this->dto->addressLine2, $this->model->getAddressLine2());
    }

    public function testSetAddressLine2(): void
    {
        $expected = "store";
        $model = $this->model;
        $model->setAddressLine2($expected);

        $this->assertEquals($expected, $model->getAddressLine2());
    }

    public function testGetState(): void
    {
        $this->assertEquals($this->dto->state, $this->model->getState());
    }

    public function testSetState(): void
    {
        $expected = "contain";
        $model = $this->model;
        $model->setState($expected);

        $this->assertEquals($expected, $model->getState());
    }

    public function testGetCountry(): void
    {
        $this->assertEquals($this->dto->country, $this->model->getCountry());
    }

    public function testSetCountry(): void
    {
        $expected = "computer";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "resource";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetTerritory(): void
    {
        $this->assertEquals($this->dto->territory, $this->model->getTerritory());
    }

    public function testSetTerritory(): void
    {
        $expected = "another";
        $model = $this->model;
        $model->setTerritory($expected);

        $this->assertEquals($expected, $model->getTerritory());
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