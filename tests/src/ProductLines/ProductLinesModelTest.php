<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Tests\ProductLines;

use PHPUnit\Framework\TestCase;
use ClassicCarScaleModels\ProductLines\{ ProductLinesDto, ProductLinesModel };

class ProductLinesModelTest extends TestCase
{
    private array $input;
    private ProductLinesDto $dto;
    private ProductLinesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "product_line_number" => 5089,
            "product_line" => "stay",
            "text_description" => "all",
            "html_description" => "Modern team garden firm product campaign quality might. Need record of memory yeah walk forward.",
            "image" => "Cup remain want seem myself especially.",
        ];
        $this->dto = new ProductLinesDto($this->input);
        $this->model = new ProductLinesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ProductLinesModel(null);

        $this->assertInstanceOf(ProductLinesModel::class, $model);
    }

    public function testGetProductLineNumber(): void
    {
        $this->assertEquals($this->dto->productLineNumber, $this->model->getProductLineNumber());
    }

    public function testSetProductLineNumber(): void
    {
        $expected = 9509;
        $model = $this->model;
        $model->setProductLineNumber($expected);

        $this->assertEquals($expected, $model->getProductLineNumber());
    }

    public function testGetProductLine(): void
    {
        $this->assertEquals($this->dto->productLine, $this->model->getProductLine());
    }

    public function testSetProductLine(): void
    {
        $expected = "something";
        $model = $this->model;
        $model->setProductLine($expected);

        $this->assertEquals($expected, $model->getProductLine());
    }

    public function testGetTextDescription(): void
    {
        $this->assertEquals($this->dto->textDescription, $this->model->getTextDescription());
    }

    public function testSetTextDescription(): void
    {
        $expected = "possible";
        $model = $this->model;
        $model->setTextDescription($expected);

        $this->assertEquals($expected, $model->getTextDescription());
    }

    public function testGetHtmlDescription(): void
    {
        $this->assertEquals($this->dto->htmlDescription, $this->model->getHtmlDescription());
    }

    public function testSetHtmlDescription(): void
    {
        $expected = "Scientist dark their owner education. Stage member wind three with term.";
        $model = $this->model;
        $model->setHtmlDescription($expected);

        $this->assertEquals($expected, $model->getHtmlDescription());
    }

    public function testGetImage(): void
    {
        $this->assertEquals($this->dto->image, $this->model->getImage());
    }

    public function testSetImage(): void
    {
        $expected = "Ground lawyer blood economic radio.";
        $model = $this->model;
        $model->setImage($expected);

        $this->assertEquals($expected, $model->getImage());
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