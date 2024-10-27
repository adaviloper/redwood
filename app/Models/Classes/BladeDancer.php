<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\NewPlayerContract;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class BladeDancer extends PlayerCharacter implements NewPlayerContract
{
    use HasFactory;
    use HasParent;

    const LEVEL_1_MAX_HEALTH = 11;
    const LEVEL_2_MAX_HEALTH = 16;
    const LEVEL_3_MAX_HEALTH = 21;
    const LEVEL_4_MAX_HEALTH = 26;
    const LEVEL_5_MAX_HEALTH = 31;
    const LEVEL_6_MAX_HEALTH = 36;

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
            Abilities::STRENGTH => 0,
            Abilities::DEXTERITY => 2,
            Abilities::CONSTITUTION => -2,
            Abilities::INTELLIGENCE => -1,
            Abilities::WISDOM => -1,
            Abilities::CHARISMA => 2,
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
