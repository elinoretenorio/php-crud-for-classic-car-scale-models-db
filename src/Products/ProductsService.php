<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

class ProductsService implements IProductsService
{
    private IProductsRepository $repository;

    public function __construct(IProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ProductsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ProductsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $productNumber): ?ProductsModel
    {
        $dto = $this->repository->get($productNumber);
        if ($dto === null) {
            return null;
        }

        return new ProductsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ProductsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ProductsModel($dto);
        }

        return $result;
    }

    public function delete(int $productNumber): int
    {
        return $this->repository->delete($productNumber);
    }

    public function createModel(array $row): ?ProductsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ProductsDto($row);

        return new ProductsModel($dto);
    }
}