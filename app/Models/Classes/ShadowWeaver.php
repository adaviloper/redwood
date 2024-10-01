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

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
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
        return match($level) {
            1 => 10,
            2 => 14,
            3 => 19,
            4 => 24,
            5 => 28,
            6 => 32,
        };
    }
}
