<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Orders;

class OrdersDto 
{
    public int $orderNumber;
    public string $orderDate;
    public string $requiredDate;
    public string $shippedDate;
    public string $status;
    public string $comments;
    public int $customerNumber;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->orderNumber = (int) ($row["order_number"] ?? 0);
        $this->orderDate = $row["order_date"] ?? "";
        $this->requiredDate = $row["required_date"] ?? "";
        $this->shippedDate = $row["shipped_date"] ?? "";
        $this->status = $row["status"] ?? "";
        $this->comments = $row["comments"] ?? "";
        $this->customerNumber = (int) ($row["customer_number"] ?? 0);
    }
}