<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

interface IPaymentsService
{
    public function insert(PaymentsModel $model): int;

    public function update(PaymentsModel $model): int;

    public function get(int $paymentNumber): ?PaymentsModel;

    public function getAll(): array;

    public function delete(int $paymentNumber): int;

    public function createModel(array $row): ?PaymentsModel;
}