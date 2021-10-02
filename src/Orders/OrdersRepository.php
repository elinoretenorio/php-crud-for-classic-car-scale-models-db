<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Orders;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class OrdersRepository implements IOrdersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(OrdersDto $dto): int
    {
        $sql = "INSERT INTO `orders` (`order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderDate,
                $dto->requiredDate,
                $dto->shippedDate,
                $dto->status,
                $dto->comments,
                $dto->customerNumber
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(OrdersDto $dto): int
    {
        $sql = "UPDATE `orders` SET `order_date` = ?, `required_date` = ?, `shipped_date` = ?, `status` = ?, `comments` = ?, `customer_number` = ?
                WHERE `order_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderDate,
                $dto->requiredDate,
                $dto->shippedDate,
                $dto->status,
                $dto->comments,
                $dto->customerNumber,
                $dto->orderNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $orderNumber): ?OrdersDto
    {
        $sql = "SELECT `order_number`, `order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`
                FROM `orders` WHERE `order_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new OrdersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `order_number`, `order_date`, `required_date`, `shipped_date`, `status`, `comments`, `customer_number`
                FROM `orders`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new OrdersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $orderNumber): int
    {
        $sql = "DELETE FROM `orders` WHERE `order_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}