<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

class ProductLinesService implements IProductLinesService
{
    private IProductLinesRepository $repository;

    public function __construct(IProductLinesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ProductLinesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ProductLinesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $productLineNumber): ?ProductLinesModel
    {
        $dto = $this->repository->get($productLineNumber);
        if ($dto === null) {
            return null;
        }

        return new ProductLinesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ProductLinesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ProductLinesModel($dto);
        }

        return $result;
    }

    public function delete(int $productLineNumber): int
    {
        return $this->repository->delete($productLineNumber);
    }

    public function createModel(array $row): ?ProductLinesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ProductLinesDto($row);

        return new ProductLinesModel($dto);
    }
}