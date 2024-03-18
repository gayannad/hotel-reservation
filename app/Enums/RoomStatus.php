<?php

namespace App\Enums;

enum RoomStatus: int
{
    case AVAILABLE = 1;
    case RESERVED = 2;

    public function toString(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::RESERVED => 'Reserved'
        };
    }

}
