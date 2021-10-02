<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

interface IOrderDetailsService
{
    public function insert(OrderDetailsModel $model): int;

    public function update(OrderDetailsModel $model): int;

    public function get(int $orderDetailNumber): ?OrderDetailsModel;

    public function getAll(): array;

    public function delete(int $orderDetailNumber): int;

    public function createModel(array $row): ?OrderDetailsModel;
}