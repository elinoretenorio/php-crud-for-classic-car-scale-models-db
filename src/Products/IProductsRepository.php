<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

interface IProductsRepository
{
    public function insert(ProductsDto $dto): int;

    public function update(ProductsDto $dto): int;

    public function get(int $productNumber): ?ProductsDto;

    public function getAll(): array;

    public function delete(int $productNumber): int;
}