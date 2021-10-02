<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

class PaymentsDto 
{
    public int $paymentNumber;
    public int $customerNumber;
    public string $checkNumber;
    public string $paymentDate;
    public float $amount;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->paymentNumber = (int) ($row["payment_number"] ?? 0);
        $this->customerNumber = (int) ($row["customer_number"] ?? 0);
        $this->checkNumber = $row["check_number"] ?? "";
        $this->paymentDate = $row["payment_date"] ?? "";
        $this->amount = (float) ($row["amount"] ?? 0);
    }
}