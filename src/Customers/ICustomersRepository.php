<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Customers;

interface ICustomersRepository
{
    public function insert(CustomersDto $dto): int;

    public function update(CustomersDto $dto): int;

    public function get(int $customerNumber): ?CustomersDto;

    public function getAll(): array;

    public function delete(int $customerNumber): int;
}