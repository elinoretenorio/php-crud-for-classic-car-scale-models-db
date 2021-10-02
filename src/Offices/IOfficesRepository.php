<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

interface IOfficesRepository
{
    public function insert(OfficesDto $dto): int;

    public function update(OfficesDto $dto): int;

    public function get(int $officeNumber): ?OfficesDto;

    public function getAll(): array;

    public function delete(int $officeNumber): int;
}