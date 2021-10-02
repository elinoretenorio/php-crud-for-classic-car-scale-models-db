<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Orders;

use JsonSerializable;

class OrdersModel implements JsonSerializable
{
    private int $orderNumber;
    private string $orderDate;
    private string $requiredDate;
    private string $shippedDate;
    private string $status;
    private string $comments;
    private int $customerNumber;

    public function __construct(OrdersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->orderNumber = $dto->orderNumber;
        $this->orderDate = $dto->orderDate;
        $this->requiredDate = $dto->requiredDate;
        $this->shippedDate = $dto->shippedDate;
        $this->status = $dto->status;
        $this->comments = $dto->comments;
        $this->customerNumber = $dto->customerNumber;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    public function getRequiredDate(): string
    {
        return $this->requiredDate;
    }

    public function setRequiredDate(string $requiredDate): void
    {
        $this->requiredDate = $requiredDate;
    }

    public function getShippedDate(): string
    {
        return $this->shippedDate;
    }

    public function setShippedDate(string $shippedDate): void
    {
        $this->shippedDate = $shippedDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    public function getCustomerNumber(): int
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(int $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    public function toDto(): OrdersDto
    {
        $dto = new OrdersDto();
        $dto->orderNumber = (int) ($this->orderNumber ?? 0);
        $dto->orderDate = $this->orderDate ?? "";
        $dto->requiredDate = $this->requiredDate ?? "";
        $dto->shippedDate = $this->shippedDate ?? "";
        $dto->status = $this->status ?? "";
        $dto->comments = $this->comments ?? "";
        $dto->customerNumber = (int) ($this->customerNumber ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "order_number" => $this->orderNumber,
            "order_date" => $this->orderDate,
            "required_date" => $this->requiredDate,
            "shipped_date" => $this->shippedDate,
            "status" => $this->status,
            "comments" => $this->comments,
            "customer_number" => $this->customerNumber,
        ];
    }
}