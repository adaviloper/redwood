<?php

namespace App\Enums;

trait HasValues
{
    public static function values(): array
    {
        return array_map(callback: fn (self $case) => $case->value, array: self::cases());
    }
}
