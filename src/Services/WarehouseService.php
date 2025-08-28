<?php

class WarehouseService
{
    public function edit(string $name, string $category, int $amount): bool
    {
        if ($name === '' || $category === '' || !is_numeric($amount) || filter_var(
                $amount,
                FILTER_VALIDATE_INT
            ) === false) {
            return false;
        }
        $amount = (int)$amount;

        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $pdo->prepare(
            'INSERT INTO item (name, category, amount)
             VALUES(:name, :category, :amount)
             ON CONFLICT(name, category)
             DO UPDATE SET amount = item.amount + excluded.amount'
        );
        $statement->execute([
            ':name' => $name,
            ':category' => $category,
            ':amount' => $amount
        ]);

        return true;
    }

    public function getItems(): array
    {
        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare(
            "SELECT name, category, amount
               FROM item
           ORDER BY name COLLATE NOCASE, category COLLATE NOCASE");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    private function createItemDto(array $item): ItemDto
    {
        return new ItemDto(
            $item['name'],
            $item['category'],
            $item['amount']
        );
    }
}