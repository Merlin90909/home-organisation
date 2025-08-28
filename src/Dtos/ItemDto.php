<?php


readonly class ItemDto
{
    public function __construct(
        public string $name,
        public string $category,
        public int $amount
    ) {
    }
}