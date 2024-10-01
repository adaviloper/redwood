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
            1 => 10,
            2 => 14,
            3 => 18,
            4 => 23,
            5 => 27,
            6 => 32,
        };
    }
}
