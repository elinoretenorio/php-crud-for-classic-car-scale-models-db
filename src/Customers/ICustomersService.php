<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Customers;

interface ICustomersService
{
    public function insert(CustomersModel $model): int;

    public function update(CustomersModel $model): int;

    public function get(int $customerNumber): ?CustomersModel;

    public function getAll(): array;

    public function delete(int $customerNumber): int;

    public function createModel(array $row): ?CustomersModel;
}