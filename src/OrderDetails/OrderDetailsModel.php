<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

use JsonSerializable;

class OrderDetailsModel implements JsonSerializable
{
    private int $orderDetailNumber;
    private int $orderNumber;
    private string $productCode;
    private int $quantityOrdered;
    private float $priceEach;
    private int $orderLineNumber;

    public function __construct(OrderDetailsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->orderDetailNumber = $dto->orderDetailNumber;
        $this->orderNumber = $dto->orderNumber;
        $this->productCode = $dto->productCode;
        $this->quantityOrdered = $dto->quantityOrdered;
        $this->priceEach = $dto->priceEach;
        $this->orderLineNumber = $dto->orderLineNumber;
    }

    public function getOrderDetailNumber(): int
    {
        return $this->orderDetailNumber;
    }

    public function setOrderDetailNumber(int $orderDetailNumber): void
    {
        $this->orderDetailNumber = $orderDetailNumber;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }

    public function setProductCode(string $productCode): void
    {
        $this->productCode = $productCode;
    }

    public function getQuantityOrdered(): int
    {
        return $this->quantityOrdered;
    }

    public function setQuantityOrdered(int $quantityOrdered): void
    {
        $this->quantityOrdered = $quantityOrdered;
    }

    public function getPriceEach(): float
    {
        return $this->priceEach;
    }

    public function setPriceEach(float $priceEach): void
    {
        $this->priceEach = $priceEach;
    }

    public function getOrderLineNumber(): int
    {
        return $this->orderLineNumber;
    }

    public function setOrderLineNumber(int $orderLineNumber): void
    {
        $this->orderLineNumber = $orderLineNumber;
    }

    public function toDto(): OrderDetailsDto
    {
        $dto = new OrderDetailsDto();
        $dto->orderDetailNumber = (int) ($this->orderDetailNumber ?? 0);
        $dto->orderNumber = (int) ($this->orderNumber ?? 0);
        $dto->productCode = $this->productCode ?? "";
        $dto->quantityOrdered = (int) ($this->quantityOrdered ?? 0);
        $dto->priceEach = (float) ($this->priceEach ?? 0);
        $dto->orderLineNumber = (int) ($this->orderLineNumber ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "order_detail_number" => $this->orderDetailNumber,
            "order_number" => $this->orderNumber,
            "product_code" => $this->productCode,
            "quantity_ordered" => $this->quantityOrdered,
            "price_each" => $this->priceEach,
            "order_line_number" => $this->orderLineNumber,
        ];
    }
}