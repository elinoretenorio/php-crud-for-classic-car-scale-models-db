<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

use JsonSerializable;

class ProductsModel implements JsonSerializable
{
    private int $productNumber;
    private string $productCode;
    private string $productName;
    private string $productLine;
    private string $productScale;
    private string $productVendor;
    private string $productDescription;
    private int $quantityInStock;
    private float $buyPrice;
    private float $msrp;

    public function __construct(ProductsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->productNumber = $dto->productNumber;
        $this->productCode = $dto->productCode;
        $this->productName = $dto->productName;
        $this->productLine = $dto->productLine;
        $this->productScale = $dto->productScale;
        $this->productVendor = $dto->productVendor;
        $this->productDescription = $dto->productDescription;
        $this->quantityInStock = $dto->quantityInStock;
        $this->buyPrice = $dto->buyPrice;
        $this->msrp = $dto->msrp;
    }

    public function getProductNumber(): int
    {
        return $this->productNumber;
    }

    public function setProductNumber(int $productNumber): void
    {
        $this->productNumber = $productNumber;
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }

    public function setProductCode(string $productCode): void
    {
        $this->productCode = $productCode;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getProductLine(): string
    {
        return $this->productLine;
    }

    public function setProductLine(string $productLine): void
    {
        $this->productLine = $productLine;
    }

    public function getProductScale(): string
    {
        return $this->productScale;
    }

    public function setProductScale(string $productScale): void
    {
        $this->productScale = $productScale;
    }

    public function getProductVendor(): string
    {
        return $this->productVendor;
    }

    public function setProductVendor(string $productVendor): void
    {
        $this->productVendor = $productVendor;
    }

    public function getProductDescription(): string
    {
        return $this->productDescription;
    }

    public function setProductDescription(string $productDescription): void
    {
        $this->productDescription = $productDescription;
    }

    public function getQuantityInStock(): int
    {
        return $this->quantityInStock;
    }

    public function setQuantityInStock(int $quantityInStock): void
    {
        $this->quantityInStock = $quantityInStock;
    }

    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(float $buyPrice): void
    {
        $this->buyPrice = $buyPrice;
    }

    public function getMsrp(): float
    {
        return $this->msrp;
    }

    public function setMsrp(float $msrp): void
    {
        $this->msrp = $msrp;
    }

    public function toDto(): ProductsDto
    {
        $dto = new ProductsDto();
        $dto->productNumber = (int) ($this->productNumber ?? 0);
        $dto->productCode = $this->productCode ?? "";
        $dto->productName = $this->productName ?? "";
        $dto->productLine = $this->productLine ?? "";
        $dto->productScale = $this->productScale ?? "";
        $dto->productVendor = $this->productVendor ?? "";
        $dto->productDescription = $this->productDescription ?? "";
        $dto->quantityInStock = (int) ($this->quantityInStock ?? 0);
        $dto->buyPrice = (float) ($this->buyPrice ?? 0);
        $dto->msrp = (float) ($this->msrp ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "product_number" => $this->productNumber,
            "product_code" => $this->productCode,
            "product_name" => $this->productName,
            "product_line" => $this->productLine,
            "product_scale" => $this->productScale,
            "product_vendor" => $this->productVendor,
            "product_description" => $this->productDescription,
            "quantity_in_stock" => $this->quantityInStock,
            "buy_price" => $this->buyPrice,
            "msrp" => $this->msrp,
        ];
    }
}