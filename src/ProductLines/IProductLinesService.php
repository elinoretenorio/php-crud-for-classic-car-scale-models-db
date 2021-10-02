<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

interface IProductLinesService
{
    public function insert(ProductLinesModel $model): int;

    public function update(ProductLinesModel $model): int;

    public function get(int $productLineNumber): ?ProductLinesModel;

    public function getAll(): array;

    public function delete(int $productLineNumber): int;

    public function createModel(array $row): ?ProductLinesModel;
}