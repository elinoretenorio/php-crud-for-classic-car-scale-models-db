<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Orders;

interface IOrdersService
{
    public function insert(OrdersModel $model): int;

    public function update(OrdersModel $model): int;

    public function get(int $orderNumber): ?OrdersModel;

    public function getAll(): array;

    public function delete(int $orderNumber): int;

    public function createModel(array $row): ?OrdersModel;
}