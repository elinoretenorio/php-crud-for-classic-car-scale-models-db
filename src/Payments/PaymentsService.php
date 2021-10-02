<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

class PaymentsService implements IPaymentsService
{
    private IPaymentsRepository $repository;

    public function __construct(IPaymentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PaymentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PaymentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $paymentNumber): ?PaymentsModel
    {
        $dto = $this->repository->get($paymentNumber);
        if ($dto === null) {
            return null;
        }

        return new PaymentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PaymentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PaymentsModel($dto);
        }

        return $result;
    }

    public function delete(int $paymentNumber): int
    {
        return $this->repository->delete($paymentNumber);
    }

    public function createModel(array $row): ?PaymentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PaymentsDto($row);

        return new PaymentsModel($dto);
    }
}