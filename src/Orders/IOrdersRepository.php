<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Orders;

interface IOrdersRepository
{
    public function insert(OrdersDto $dto): int;

    public function update(OrdersDto $dto): int;

    public function get(int $orderNumber): ?OrdersDto;

    public function getAll(): array;

    public function delete(int $orderNumber): int;
}