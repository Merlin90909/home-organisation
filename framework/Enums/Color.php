<?php
namespace Framework\Enums;
enum Color: int
{
    case RESET = 0;
    case RED = 31;
    case GREEN = 32;
    case BLUE = 34;
    case YELLOW = 33;
    case BLACK = 30;
    case WHITE = 97;

    public static function toArray(): array
    {
        return array_column(self::cases(),null, 'name');
    }
}