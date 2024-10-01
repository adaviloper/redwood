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
            1 => 11,
            2 => 16,
            3 => 21,
            4 => 26,
            5 => 31,
            6 => 36,
        };
    }
}
