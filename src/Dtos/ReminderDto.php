<?php

namespace Dtos;

readonly class ReminderDto
{
    public function __construct(
        public string $title,
        public string $note,
        public string $duo_at,
        public string $repeat_rules,
        public string $priority
    ) {
    }
}