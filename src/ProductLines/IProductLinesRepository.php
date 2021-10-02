<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

interface IProductLinesRepository
{
    public function insert(ProductLinesDto $dto): int;

    public function update(ProductLinesDto $dto): int;

    public function get(int $productLineNumber): ?ProductLinesDto;

    public function getAll(): array;

    public function delete(int $productLineNumber): int;
}