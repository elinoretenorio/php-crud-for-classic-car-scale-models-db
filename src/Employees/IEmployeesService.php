<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

interface IEmployeesService
{
    public function insert(EmployeesModel $model): int;

    public function update(EmployeesModel $model): int;

    public function get(int $employeeNumber): ?EmployeesModel;

    public function getAll(): array;

    public function delete(int $employeeNumber): int;

    public function createModel(array $row): ?EmployeesModel;
}