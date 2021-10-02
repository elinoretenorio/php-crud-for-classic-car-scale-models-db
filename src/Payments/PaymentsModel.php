<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

use JsonSerializable;

class PaymentsModel implements JsonSerializable
{
    private int $paymentNumber;
    private int $customerNumber;
    private string $checkNumber;
    private string $paymentDate;
    private float $amount;

    public function __construct(PaymentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->paymentNumber = $dto->paymentNumber;
        $this->customerNumber = $dto->customerNumber;
        $this->checkNumber = $dto->checkNumber;
        $this->paymentDate = $dto->paymentDate;
        $this->amount = $dto->amount;
    }

    public function getPaymentNumber(): int
    {
        return $this->paymentNumber;
    }

    public function setPaymentNumber(int $paymentNumber): void
    {
        $this->paymentNumber = $paymentNumber;
    }

    public function getCustomerNumber(): int
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(int $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    public function getCheckNumber(): string
    {
        return $this->checkNumber;
    }

    public function setCheckNumber(string $checkNumber): void
    {
        $this->checkNumber = $checkNumber;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(string $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function toDto(): PaymentsDto
    {
        $dto = new PaymentsDto();
        $dto->paymentNumber = (int) ($this->paymentNumber ?? 0);
        $dto->customerNumber = (int) ($this->customerNumber ?? 0);
        $dto->checkNumber = $this->checkNumber ?? "";
        $dto->paymentDate = $this->paymentDate ?? "";
        $dto->amount = (float) ($this->amount ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "payment_number" => $this->paymentNumber,
            "customer_number" => $this->customerNumber,
            "check_number" => $this->checkNumber,
            "payment_date" => $this->paymentDate,
            "amount" => $this->amount,
        ];
    }
}