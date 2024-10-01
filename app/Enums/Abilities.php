<?php

namespace App\Enums;

enum Abilities: string
{
    use HasValues;

    case STRENGTH = 'strength';
    case DEXTERITY = 'dexterity';
    case CONSTITUTION = 'constitution';
    case INTELLIGENCE = 'intelligence';
    case WISDOM = 'wisdom';
    case CHARISMA = 'charisma';

    public function type(): string
    {
        return match($this) {
            self::STRENGTH => 'physical',
            self::DEXTERITY => 'physical',
            self::CONSTITUTION => 'physical',
            self::INTELLIGENCE => 'mental',
            self::WISDOM => 'mental',
            self::CHARISMA => 'mental',
        };
    }
}
