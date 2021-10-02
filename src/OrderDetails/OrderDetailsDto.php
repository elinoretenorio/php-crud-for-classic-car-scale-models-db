<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

class OrderDetailsDto 
{
    public int $orderDetailNumber;
    public int $orderNumber;
    public string $productCode;
    public int $quantityOrdered;
    public float $priceEach;
    public int $orderLineNumber;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->orderDetailNumber = (int) ($row["order_detail_number"] ?? 0);
        $this->orderNumber = (int) ($row["order_number"] ?? 0);
        $this->productCode = $row["product_code"] ?? "";
        $this->quantityOrdered = (int) ($row["quantity_ordered"] ?? 0);
        $this->priceEach = (float) ($row["price_each"] ?? 0);
        $this->orderLineNumber = (int) ($row["order_line_number"] ?? 0);
    }
}