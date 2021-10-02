<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\OrderDetails;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class OrderDetailsRepository implements IOrderDetailsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(OrderDetailsDto $dto): int
    {
        $sql = "INSERT INTO `order_details` (`order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderNumber,
                $dto->productCode,
                $dto->quantityOrdered,
                $dto->priceEach,
                $dto->orderLineNumber
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(OrderDetailsDto $dto): int
    {
        $sql = "UPDATE `order_details` SET `order_number` = ?, `product_code` = ?, `quantity_ordered` = ?, `price_each` = ?, `order_line_number` = ?
                WHERE `order_detail_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderNumber,
                $dto->productCode,
                $dto->quantityOrdered,
                $dto->priceEach,
                $dto->orderLineNumber,
                $dto->orderDetailNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $orderDetailNumber): ?OrderDetailsDto
    {
        $sql = "SELECT `order_detail_number`, `order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`
                FROM `order_details` WHERE `order_detail_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderDetailNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new OrderDetailsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `order_detail_number`, `order_number`, `product_code`, `quantity_ordered`, `price_each`, `order_line_number`
                FROM `order_details`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new OrderDetailsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $orderDetailNumber): int
    {
        $sql = "DELETE FROM `order_details` WHERE `order_detail_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderDetailNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}