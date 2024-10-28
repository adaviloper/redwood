<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class ShadowWeaver extends PlayerCharacter
{
    use HasFactory;
    use HasParent;

    public const LEVEL_1_MAX_HEALTH = 10;
    public const LEVEL_2_MAX_HEALTH = 14;
    public const LEVEL_3_MAX_HEALTH = 19;
    public const LEVEL_4_MAX_HEALTH = 24;
    public const LEVEL_5_MAX_HEALTH = 28;
    public const LEVEL_6_MAX_HEALTH = 32;

    public function abilityValueFor(Abilities $ability): int
    {
        return match ($ability) {
            Abilities::STRENGTH => -1,
            Abilities::DEXTERITY => 1,
            Abilities::CONSTITUTION => 2,
            Abilities::INTELLIGENCE => -2,
            Abilities::WISDOM => -1,
            Abilities::CHARISMA => 1,
        };
    }

    public function maxHealthAtLevel(int $level): int
    {
        return match ($level) {
            6 => self::LEVEL_6_MAX_HEALTH,
            5 => self::LEVEL_5_MAX_HEALTH,
            4 => self::LEVEL_4_MAX_HEALTH,
            3 => self::LEVEL_3_MAX_HEALTH,
            2 => self::LEVEL_2_MAX_HEALTH,
            default => self::LEVEL_1_MAX_HEALTH,
        };
    }
}
