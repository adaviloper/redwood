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
        return match($this) {
            self::WIND_CHASER => Str::slug(self::WIND_CHASER->value),
            self::THORN_WEAVER => Str::slug(self::THORN_WEAVER->value),
            self::SPELL_KEEPER => Str::slug(self::SPELL_KEEPER->value),
            self::BLADE_DANCER => Str::slug(self::BLADE_DANCER->value),
            self::SHADOW_WEAVER => Str::slug(self::SHADOW_WEAVER->value),
            self::LIGHT_SEEKER => Str::slug(self::LIGHT_SEEKER->value),
        };
    }
}
