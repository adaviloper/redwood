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

    public function abilityValueFor(Abilities $ability): int
    {
        return match($ability) {
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
