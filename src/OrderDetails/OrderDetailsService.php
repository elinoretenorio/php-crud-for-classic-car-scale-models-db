<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

class OrderDetailsService implements IOrderDetailsService
{
    private IOrderDetailsRepository $repository;

    public function __construct(IOrderDetailsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(OrderDetailsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(OrderDetailsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $orderDetailNumber): ?OrderDetailsModel
    {
        $dto = $this->repository->get($orderDetailNumber);
        if ($dto === null) {
            return null;
        }

        return new OrderDetailsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var OrderDetailsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new OrderDetailsModel($dto);
        }

        return $result;
    }

    public function delete(int $orderDetailNumber): int
    {
        return $this->repository->delete($orderDetailNumber);
    }

    public function createModel(array $row): ?OrderDetailsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new OrderDetailsDto($row);

        return new OrderDetailsModel($dto);
    }
}