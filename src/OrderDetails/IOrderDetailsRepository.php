<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

interface IOrderDetailsRepository
{
    public function insert(OrderDetailsDto $dto): int;

    public function update(OrderDetailsDto $dto): int;

    public function get(int $orderDetailNumber): ?OrderDetailsDto;

    public function getAll(): array;

    public function delete(int $orderDetailNumber): int;
}