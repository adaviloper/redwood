<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class SpellKeeper extends PlayerCharacter
{
    use HasFactory;
    use HasParent;

    public const LEVEL_1_MAX_HEALTH = 11;
    public const LEVEL_2_MAX_HEALTH = 16;
    public const LEVEL_3_MAX_HEALTH = 21;
    public const LEVEL_4_MAX_HEALTH = 26;
    public const LEVEL_5_MAX_HEALTH = 31;
    public const LEVEL_6_MAX_HEALTH = 36;

    public function abilityValueFor(Abilities $ability): int
    {
        return match ($ability) {
            Abilities::STRENGTH => -1,
            Abilities::DEXTERITY => -1,
            Abilities::CONSTITUTION => -1,
            Abilities::INTELLIGENCE => 2,
            Abilities::WISDOM => 2,
            Abilities::CHARISMA => -1,
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
