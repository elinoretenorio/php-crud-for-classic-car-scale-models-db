<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

interface IOfficesService
{
    public function insert(OfficesModel $model): int;

    public function update(OfficesModel $model): int;

    public function get(int $officeNumber): ?OfficesModel;

    public function getAll(): array;

    public function delete(int $officeNumber): int;

    public function createModel(array $row): ?OfficesModel;
}