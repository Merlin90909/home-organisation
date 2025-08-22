<?php

use Dtos\ReminderDto;

class ReminderService
{
    public function getReminderbyName(string $title): ?ReminderDto
    {
        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare(
            "SELECT title, notes, duo_at, priority, status, created_at FROM reminder WHERE title = :title"
        );
        $stmt->execute(['title' => $title]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->createReminderDto($row);
    }

    public function getReminder(): array
    {
        $pdo = new PDO('sqlite:' . __DIR__ . '/../../data/home-organisation.sqlite');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT title, notes, duo_at, priority, status FROM reminder");
        $reminder = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $reminder;
    }

    private function createReminderDto(array $reminder): ReminderDto
    {
        return new ReminderDto(
            $reminder['title'],
            $reminder['notes'],
            $reminder['duo_at'],
            $reminder['priority'],
            $reminder['status'],
        );
    }
}
