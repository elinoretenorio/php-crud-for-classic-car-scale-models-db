<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

class OfficesService implements IOfficesService
{
    private IOfficesRepository $repository;

    public function __construct(IOfficesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(OfficesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(OfficesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $officeNumber): ?OfficesModel
    {
        $dto = $this->repository->get($officeNumber);
        if ($dto === null) {
            return null;
        }

        return new OfficesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var OfficesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new OfficesModel($dto);
        }

        return $result;
    }

    public function delete(int $officeNumber): int
    {
        return $this->repository->delete($officeNumber);
    }

    public function createModel(array $row): ?OfficesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new OfficesDto($row);

        return new OfficesModel($dto);
    }
}