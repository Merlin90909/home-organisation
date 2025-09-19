<?php

namespace App\Services;

use PDO;

class TaskCreateService
{
    public function __construct(private PDO $pdo)
    {
    }

    function create(
        int $userId,
        int $roomId,
        string $title,
        string $notes,
        string $due_at,
        string $priority,
        bool $repeat,
        string $repeat_rule,
        string $status,
        string $created_at
    ) {
        if (empty($userId) || empty($roomId) || empty($title) || empty($notes) || empty($due_at) || empty($priority) || empty($repeat) || empty($repeat_rule) || empty($status)) {
            return false;
        }

        $statement = $this->pdo->prepare(
            'INSERT INTO task (created_by, created_for, title, notes, due_at, priority, repeat, repeat_rule, status, created_at) 
                    VALUES (:created_by, :created_for, :title, :notes, :due_at, :priority, :repeat, :repeat_rule, :status, :created_at)'
        );
        $statement->execute([
            'created_by' => $userId,
            'created_for' => $roomId,
            'title' => $title,
            'notes' => $notes,
            'due_at' => $due_at,
            'priority' => $priority,
            'repeat' => $repeat,
            'repeat_rule' => $repeat_rule,
            'status' => $status,
            'created_at' => $created_at
        ]);
        $taskId = $this->pdo->lastInsertId();

        $statement = $this->pdo->prepare(
            'INSERT INTO user_to_task (owner_user_id, task_id) VALUES (:owner_user_id, :task_id)'
        );
        $statement->execute([
            'owner_user_id' => $userId,
            'task_id' => $taskId,
        ]);
        $stmt2 = $this->pdo->prepare(
            'INSERT INTO room_to_task (room_id, task_id) VALUES (:room_id, :task_id)'
        );
        $stmt2->execute([
            'room_id' => $roomId,
            'task_id' => $taskId,
        ]);

        return true;
    }
}