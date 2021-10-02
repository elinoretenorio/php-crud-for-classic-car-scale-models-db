<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

class EmployeesService implements IEmployeesService
{
    private IEmployeesRepository $repository;

    public function __construct(IEmployeesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(EmployeesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(EmployeesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $employeeNumber): ?EmployeesModel
    {
        $dto = $this->repository->get($employeeNumber);
        if ($dto === null) {
            return null;
        }

        return new EmployeesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var EmployeesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new EmployeesModel($dto);
        }

        return $result;
    }

    public function delete(int $employeeNumber): int
    {
        return $this->repository->delete($employeeNumber);
    }

    public function createModel(array $row): ?EmployeesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new EmployeesDto($row);

        return new EmployeesModel($dto);
    }
}