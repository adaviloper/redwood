<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class ThornWeaver extends PlayerCharacter
{
    use HasFactory;
    use HasParent;

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
            Abilities::STRENGTH => 0,
            Abilities::DEXTERITY => 2,
            Abilities::CONSTITUTION => -2,
            Abilities::INTELLIGENCE => 2,
            Abilities::WISDOM => -2,
            Abilities::CHARISMA => 0,
        };
    }

    public function maxHealthAtLevel(int $level): int
    {
        return match($level) {
            1 => 10,
            2 => 15,
            3 => 18,
            4 => 22,
            5 => 26,
            6 => 30,
        };
    }
}
