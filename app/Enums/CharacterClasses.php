<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum CharacterClasses: string
{
    use HasValues;

    case WIND_CHASER = 'Wind Chaser';
    case THORN_WEAVER = 'Thorn Weaver';
    case SPELL_KEEPER = 'Spell Keeper';
    case BLADE_DANCER = 'Blade Dancer';
    case SHADOW_WEAVER = 'Shadow Weaver';
    case LIGHT_SEEKER = 'Light Seeker';

    public function slug(): string
    {
        return Str::slug($this->value);
    }
}
