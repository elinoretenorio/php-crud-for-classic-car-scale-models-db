<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Employees;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class EmployeesRepository implements IEmployeesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(EmployeesDto $dto): int
    {
        $sql = "INSERT INTO `employees` (`last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->extension,
                $dto->email,
                $dto->officeCode,
                $dto->reportsTo,
                $dto->jobTitle
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(EmployeesDto $dto): int
    {
        $sql = "UPDATE `employees` SET `last_name` = ?, `first_name` = ?, `extension` = ?, `email` = ?, `office_code` = ?, `reports_to` = ?, `job_title` = ?
                WHERE `employee_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->extension,
                $dto->email,
                $dto->officeCode,
                $dto->reportsTo,
                $dto->jobTitle,
                $dto->employeeNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $employeeNumber): ?EmployeesDto
    {
        $sql = "SELECT `employee_number`, `last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`
                FROM `employees` WHERE `employee_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new EmployeesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `employee_number`, `last_name`, `first_name`, `extension`, `email`, `office_code`, `reports_to`, `job_title`
                FROM `employees`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new EmployeesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $employeeNumber): int
    {
        $sql = "DELETE FROM `employees` WHERE `employee_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}