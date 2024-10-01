<?php

namespace App\Models;

use App\Enums\Abilities;

interface NewPlayerContract
{
    public function abilityValueFor(Abilities $ability): int;
    public function maxHealthAtLevel(int $level): int;
}
