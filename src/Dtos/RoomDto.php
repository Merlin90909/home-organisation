<?php

namespace Dtos;

readonly class RoomDto
{
    //__construct = Objekt initialisieren
    public function __construct(
        public string $name,
        public string $description,
    ) {
    }
}