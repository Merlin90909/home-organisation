<?php

namespace Dtos;

readonly class ReminderDto
{
    public function __construct(
        public array $users,
        public array $rooms,
        public string $title,
        public string $note,
        public string $duo_at,
        public string $repeat_rules,
        public string $priority,
        public string $status,
        public string $created_at,
    ) {
    }
}