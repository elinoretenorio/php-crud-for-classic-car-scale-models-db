<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Offices;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class OfficesRepository implements IOfficesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(OfficesDto $dto): int
    {
        $sql = "INSERT INTO `offices` (`office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->officeCode,
                $dto->city,
                $dto->phone,
                $dto->addressLine1,
                $dto->addressLine2,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->territory
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(OfficesDto $dto): int
    {
        $sql = "UPDATE `offices` SET `office_code` = ?, `city` = ?, `phone` = ?, `address_line1` = ?, `address_line2` = ?, `state` = ?, `country` = ?, `postal_code` = ?, `territory` = ?
                WHERE `office_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->officeCode,
                $dto->city,
                $dto->phone,
                $dto->addressLine1,
                $dto->addressLine2,
                $dto->state,
                $dto->country,
                $dto->postalCode,
                $dto->territory,
                $dto->officeNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $officeNumber): ?OfficesDto
    {
        $sql = "SELECT `office_number`, `office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`
                FROM `offices` WHERE `office_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$officeNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new OfficesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `office_number`, `office_code`, `city`, `phone`, `address_line1`, `address_line2`, `state`, `country`, `postal_code`, `territory`
                FROM `offices`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new OfficesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $officeNumber): int
    {
        $sql = "DELETE FROM `offices` WHERE `office_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$officeNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}