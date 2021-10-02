<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\ProductLines;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class ProductLinesRepository implements IProductLinesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ProductLinesDto $dto): int
    {
        $sql = "INSERT INTO `product_lines` (`product_line`, `text_description`, `html_description`, `image`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productLine,
                $dto->textDescription,
                $dto->htmlDescription,
                $dto->image
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ProductLinesDto $dto): int
    {
        $sql = "UPDATE `product_lines` SET `product_line` = ?, `text_description` = ?, `html_description` = ?, `image` = ?
                WHERE `product_line_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productLine,
                $dto->textDescription,
                $dto->htmlDescription,
                $dto->image,
                $dto->productLineNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $productLineNumber): ?ProductLinesDto
    {
        $sql = "SELECT `product_line_number`, `product_line`, `text_description`, `html_description`, `image`
                FROM `product_lines` WHERE `product_line_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productLineNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ProductLinesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `product_line_number`, `product_line`, `text_description`, `html_description`, `image`
                FROM `product_lines`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ProductLinesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $productLineNumber): int
    {
        $sql = "DELETE FROM `product_lines` WHERE `product_line_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productLineNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}