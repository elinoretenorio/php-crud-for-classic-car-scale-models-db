<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Products;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class ProductsRepository implements IProductsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ProductsDto $dto): int
    {
        $sql = "INSERT INTO `products` (`product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productCode,
                $dto->productName,
                $dto->productLine,
                $dto->productScale,
                $dto->productVendor,
                $dto->productDescription,
                $dto->quantityInStock,
                $dto->buyPrice,
                $dto->msrp
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ProductsDto $dto): int
    {
        $sql = "UPDATE `products` SET `product_code` = ?, `product_name` = ?, `product_line` = ?, `product_scale` = ?, `product_vendor` = ?, `product_description` = ?, `quantity_in_stock` = ?, `buy_price` = ?, `msrp` = ?
                WHERE `product_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productCode,
                $dto->productName,
                $dto->productLine,
                $dto->productScale,
                $dto->productVendor,
                $dto->productDescription,
                $dto->quantityInStock,
                $dto->buyPrice,
                $dto->msrp,
                $dto->productNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $productNumber): ?ProductsDto
    {
        $sql = "SELECT `product_number`, `product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`
                FROM `products` WHERE `product_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ProductsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `product_number`, `product_code`, `product_name`, `product_line`, `product_scale`, `product_vendor`, `product_description`, `quantity_in_stock`, `buy_price`, `msrp`
                FROM `products`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ProductsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $productNumber): int
    {
        $sql = "DELETE FROM `products` WHERE `product_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}