<?php

namespace App\Enums;

enum Abilities: string
{
    use HasValues;

    case STRENGTH = 'strength';
    case CONSTITUTION = 'constitution';
    case DEXTERITY = 'dexterity';
    case WISDOM = 'wisdom';
    case INTELLIGENCE = 'intelligence';
    case CHARISMA = 'charisma';
}
