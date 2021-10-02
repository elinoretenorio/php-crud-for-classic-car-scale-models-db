<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

interface IProductsService
{
    public function insert(ProductsModel $model): int;

    public function update(ProductsModel $model): int;

    public function get(int $productNumber): ?ProductsModel;

    public function getAll(): array;

    public function delete(int $productNumber): int;

    public function createModel(array $row): ?ProductsModel;
}