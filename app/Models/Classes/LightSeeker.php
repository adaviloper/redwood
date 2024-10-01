<?php

namespace App\Models\Classes;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class LightSeeker extends PlayerCharacter
{
    use HasFactory;
    use HasParent;

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
            Abilities::STRENGTH => 2,
            Abilities::DEXTERITY => 1,
            Abilities::CONSTITUTION => 0,
            Abilities::INTELLIGENCE => -1,
            Abilities::WISDOM => -1,
            Abilities::CHARISMA => -1,
        };
    }

    public function maxHealthAtLevel(int $level): int
    {
        return match($level) {
            1 => 9,
            2 => 13,
            3 => 17,
            4 => 21,
            5 => 25,
            6 => 27,
        };
    }
}
