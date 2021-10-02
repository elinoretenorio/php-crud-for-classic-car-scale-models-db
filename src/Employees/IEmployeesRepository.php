<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

interface IEmployeesRepository
{
    public function insert(EmployeesDto $dto): int;

    public function update(EmployeesDto $dto): int;

    public function get(int $employeeNumber): ?EmployeesDto;

    public function getAll(): array;

    public function delete(int $employeeNumber): int;
}