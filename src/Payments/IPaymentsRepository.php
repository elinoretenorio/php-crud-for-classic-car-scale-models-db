<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

interface IPaymentsRepository
{
    public function insert(PaymentsDto $dto): int;

    public function update(PaymentsDto $dto): int;

    public function get(int $paymentNumber): ?PaymentsDto;

    public function getAll(): array;

    public function delete(int $paymentNumber): int;
}