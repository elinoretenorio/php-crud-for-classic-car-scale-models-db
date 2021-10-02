<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

use JsonSerializable;

class ProductLinesModel implements JsonSerializable
{
    private int $productLineNumber;
    private string $productLine;
    private string $textDescription;
    private string $htmlDescription;
    private string $image;

    public function __construct(ProductLinesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->productLineNumber = $dto->productLineNumber;
        $this->productLine = $dto->productLine;
        $this->textDescription = $dto->textDescription;
        $this->htmlDescription = $dto->htmlDescription;
        $this->image = $dto->image;
    }

    public function getProductLineNumber(): int
    {
        return $this->productLineNumber;
    }

    public function setProductLineNumber(int $productLineNumber): void
    {
        $this->productLineNumber = $productLineNumber;
    }

    public function getProductLine(): string
    {
        return $this->productLine;
    }

    public function setProductLine(string $productLine): void
    {
        $this->productLine = $productLine;
    }

    public function getTextDescription(): string
    {
        return $this->textDescription;
    }

    public function setTextDescription(string $textDescription): void
    {
        $this->textDescription = $textDescription;
    }

    public function getHtmlDescription(): string
    {
        return $this->htmlDescription;
    }

    public function setHtmlDescription(string $htmlDescription): void
    {
        $this->htmlDescription = $htmlDescription;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function toDto(): ProductLinesDto
    {
        $dto = new ProductLinesDto();
        $dto->productLineNumber = (int) ($this->productLineNumber ?? 0);
        $dto->productLine = $this->productLine ?? "";
        $dto->textDescription = $this->textDescription ?? "";
        $dto->htmlDescription = $this->htmlDescription ?? "";
        $dto->image = $this->image ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "product_line_number" => $this->productLineNumber,
            "product_line" => $this->productLine,
            "text_description" => $this->textDescription,
            "html_description" => $this->htmlDescription,
            "image" => $this->image,
        ];
    }
}