<?php

declare(strict_types=1);

namespace ClassicCarScaleModels\Payments;

use ClassicCarScaleModels\Database\IDatabase;
use ClassicCarScaleModels\Database\DatabaseException;

class PaymentsRepository implements IPaymentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PaymentsDto $dto): int
    {
        $sql = "INSERT INTO `payments` (`customer_number`, `check_number`, `payment_date`, `amount`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerNumber,
                $dto->checkNumber,
                $dto->paymentDate,
                $dto->amount
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PaymentsDto $dto): int
    {
        $sql = "UPDATE `payments` SET `customer_number` = ?, `check_number` = ?, `payment_date` = ?, `amount` = ?
                WHERE `payment_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerNumber,
                $dto->checkNumber,
                $dto->paymentDate,
                $dto->amount,
                $dto->paymentNumber
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $paymentNumber): ?PaymentsDto
    {
        $sql = "SELECT `payment_number`, `customer_number`, `check_number`, `payment_date`, `amount`
                FROM `payments` WHERE `payment_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$paymentNumber]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PaymentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `payment_number`, `customer_number`, `check_number`, `payment_date`, `amount`
                FROM `payments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PaymentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $paymentNumber): int
    {
        $sql = "DELETE FROM `payments` WHERE `payment_number` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$paymentNumber]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}