<?php

namespace App\Services;

use PDO;

class AccountService
{
    public function __construct(private PDO $pdo)
    {
    }

    public function showParameters(int $userId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, first_Name, last_Name, email 
                    FROM user 
                    WHERE id = :userId'
        );
        $stmt->execute(['userId' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}