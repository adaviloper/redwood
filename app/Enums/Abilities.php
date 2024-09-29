<?php

namespace App\Enums;

enum Abilities: string
{
    case STRENGTH = 'strength';
    case CONSTITUTION = 'constitution';
    case DEXTERITY = 'dexterity';
    case WISDOM = 'wisdom';
    case INTELLIGENCE = 'intelligence';
    case CHARISMA = 'charisma';

    public static function values(): array
    {
        return array_map(callback: fn (Abilities $case) => $case->value, array: Abilities::cases());
    }
}
