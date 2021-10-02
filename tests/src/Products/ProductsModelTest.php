<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\Products;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\Products\{ ProductsDto, ProductsModel };

class ProductsModelTest extends TestCase
{
    private array $input;
    private ProductsDto $dto;
    private ProductsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "product_number" => 7479,
            "product_code" => "space",
            "product_name" => "physical",
            "product_line" => "meeting",
            "product_scale" => "meeting",
            "product_vendor" => "community",
            "product_description" => "Can require our.",
            "quantity_in_stock" => 3404,
            "buy_price" => 893.70,
            "msrp" => 193.32,
        ];
        $this->dto = new ProductsDto($this->input);
        $this->model = new ProductsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ProductsModel(null);

        $this->assertInstanceOf(ProductsModel::class, $model);
    }

    public function testGetProductNumber(): void
    {
        $this->assertEquals($this->dto->productNumber, $this->model->getProductNumber());
    }

    public function testSetProductNumber(): void
    {
        $expected = 3162;
        $model = $this->model;
        $model->setProductNumber($expected);

        $this->assertEquals($expected, $model->getProductNumber());
    }

    public function testGetProductCode(): void
    {
        $this->assertEquals($this->dto->productCode, $this->model->getProductCode());
    }

    public function testSetProductCode(): void
    {
        $expected = "job";
        $model = $this->model;
        $model->setProductCode($expected);

        $this->assertEquals($expected, $model->getProductCode());
    }

    public function testGetProductName(): void
    {
        $this->assertEquals($this->dto->productName, $this->model->getProductName());
    }

    public function testSetProductName(): void
    {
        $expected = "tax";
        $model = $this->model;
        $model->setProductName($expected);

        $this->assertEquals($expected, $model->getProductName());
    }

    public function testGetProductLine(): void
    {
        $this->assertEquals($this->dto->productLine, $this->model->getProductLine());
    }

    public function testSetProductLine(): void
    {
        $expected = "success";
        $model = $this->model;
        $model->setProductLine($expected);

        $this->assertEquals($expected, $model->getProductLine());
    }

    public function testGetProductScale(): void
    {
        $this->assertEquals($this->dto->productScale, $this->model->getProductScale());
    }

    public function testSetProductScale(): void
    {
        $expected = "down";
        $model = $this->model;
        $model->setProductScale($expected);

        $this->assertEquals($expected, $model->getProductScale());
    }

    public function testGetProductVendor(): void
    {
        $this->assertEquals($this->dto->productVendor, $this->model->getProductVendor());
    }

    public function testSetProductVendor(): void
    {
        $expected = "well";
        $model = $this->model;
        $model->setProductVendor($expected);

        $this->assertEquals($expected, $model->getProductVendor());
    }

    public function testGetProductDescription(): void
    {
        $this->assertEquals($this->dto->productDescription, $this->model->getProductDescription());
    }

    public function testSetProductDescription(): void
    {
        $expected = "Painting himself offer. Student first level rate. Already color care several serious option keep.";
        $model = $this->model;
        $model->setProductDescription($expected);

        $this->assertEquals($expected, $model->getProductDescription());
    }

    public function testGetQuantityInStock(): void
    {
        $this->assertEquals($this->dto->quantityInStock, $this->model->getQuantityInStock());
    }

    public function testSetQuantityInStock(): void
    {
        $expected = 7024;
        $model = $this->model;
        $model->setQuantityInStock($expected);

        $this->assertEquals($expected, $model->getQuantityInStock());
    }

    public function testGetBuyPrice(): void
    {
        $this->assertEquals($this->dto->buyPrice, $this->model->getBuyPrice());
    }

    public function testSetBuyPrice(): void
    {
        $expected = 243.54;
        $model = $this->model;
        $model->setBuyPrice($expected);

        $this->assertEquals($expected, $model->getBuyPrice());
    }

    public function testGetMsrp(): void
    {
        $this->assertEquals($this->dto->msrp, $this->model->getMsrp());
    }

    public function testSetMsrp(): void
    {
        $expected = 467.00;
        $model = $this->model;
        $model->setMsrp($expected);

        $this->assertEquals($expected, $model->getMsrp());
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