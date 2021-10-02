<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

class ProductsDto 
{
    public int $productNumber;
    public string $productCode;
    public string $productName;
    public string $productLine;
    public string $productScale;
    public string $productVendor;
    public string $productDescription;
    public int $quantityInStock;
    public float $buyPrice;
    public float $msrp;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->productNumber = (int) ($row["product_number"] ?? 0);
        $this->productCode = $row["product_code"] ?? "";
        $this->productName = $row["product_name"] ?? "";
        $this->productLine = $row["product_line"] ?? "";
        $this->productScale = $row["product_scale"] ?? "";
        $this->productVendor = $row["product_vendor"] ?? "";
        $this->productDescription = $row["product_description"] ?? "";
        $this->quantityInStock = (int) ($row["quantity_in_stock"] ?? 0);
        $this->buyPrice = (float) ($row["buy_price"] ?? 0);
        $this->msrp = (float) ($row["msrp"] ?? 0);
    }
}