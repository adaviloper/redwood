<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class WindChaser extends PlayerCharacter
{
    use HasFactory;
    use HasParent;

    const LEVEL_1_MAX_HEALTH = 10;
    const LEVEL_2_MAX_HEALTH = 14;
    const LEVEL_3_MAX_HEALTH = 18;
    const LEVEL_4_MAX_HEALTH = 23;
    const LEVEL_5_MAX_HEALTH = 27;
    const LEVEL_6_MAX_HEALTH = 32;

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
            Abilities::STRENGTH => 0,
            Abilities::DEXTERITY => 3,
            Abilities::CONSTITUTION => 1,
            Abilities::INTELLIGENCE => -2,
            Abilities::WISDOM => 0,
            Abilities::CHARISMA => -2,
        };
    }

    public function maxHealthAtLevel(int $level): int
    {
        return match($level) {
            6 => self::LEVEL_6_MAX_HEALTH,
            5 => self::LEVEL_5_MAX_HEALTH,
            4 => self::LEVEL_4_MAX_HEALTH,
            3 => self::LEVEL_3_MAX_HEALTH,
            2 => self::LEVEL_2_MAX_HEALTH,
            default => self::LEVEL_1_MAX_HEALTH,
        };
    }
}
