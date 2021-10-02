<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Customers;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class CustomersRepository implements ICustomersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomersDto $dto): int
    {
        $sql = "INSERT INTO `customers` (`customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerName,
                $dto->contactLastName,
                $dto->contactFirstName,
                $dto->phone,
                $dto->addressLine1,
                $dto->addressLine2,
                $dto->city,
                $dto->state,
                $dto->postalCode,
                $dto->country,
                $dto->employeeNumber,
                $dto->creditLimit
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomersDto $dto): int
    {
        $sql = "UPDATE `customers` SET `customer_name` = ?, `contact_last_name` = ?, `contact_first_name` = ?, `phone` = ?, `address_line1` = ?, `address_line2` = ?, `city` = ?, `state` = ?, `postal_code` = ?, `country` = ?, `employee_number` = ?, `credit_limit` = ?
                WHERE `customer_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerName,
                $dto->contactLastName,
                $dto->contactFirstName,
                $dto->phone,
                $dto->addressLine1,
                $dto->addressLine2,
                $dto->city,
                $dto->state,
                $dto->postalCode,
                $dto->country,
                $dto->employeeNumber,
                $dto->creditLimit,
                $dto->customerNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerNumber): ?CustomersDto
    {
        $sql = "SELECT `customer_number`, `customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`
                FROM `customers` WHERE `customer_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `customer_number`, `customer_name`, `contact_last_name`, `contact_first_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`, `employee_number`, `credit_limit`
                FROM `customers`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerNumber): int
    {
        $sql = "DELETE FROM `customers` WHERE `customer_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}