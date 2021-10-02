<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

class ProductLinesDto 
{
    public int $productLineNumber;
    public string $productLine;
    public string $textDescription;
    public string $htmlDescription;
    public string $image;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->productLineNumber = (int) ($row["product_line_number"] ?? 0);
        $this->productLine = $row["product_line"] ?? "";
        $this->textDescription = $row["text_description"] ?? "";
        $this->htmlDescription = $row["html_description"] ?? "";
        $this->image = $row["image"] ?? "";
    }
}