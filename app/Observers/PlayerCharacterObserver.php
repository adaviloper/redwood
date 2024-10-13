<?php

namespace App\Observers;

use App\Enums\Abilities;
use App\Models\PlayerCharacter;

class PlayerCharacterObserver
{
    public function creating(PlayerCharacter $playerCharacter): void
    {
        $playerCharacter->max_hp = $playerCharacter->getChildClass()->maxHealthAtLevel(1);
        $playerCharacter->hp = $playerCharacter->max_hp;
    }

    /**
     * Handle the PlayerCharacter "created" event.
     */
    public function created(PlayerCharacter $playerCharacter): void
    {
        foreach (Abilities::cases() as $ability) {
            $playerCharacter->abilities()->create([
                'name' => $ability->value,
                'type' => $ability->type(),
                'value' => $playerCharacter->getChildClass()->abilityValueFor($ability),
            ]);
        }
    }

    /**
     * Handle the PlayerCharacter "updated" event.
     */
    public function updated(PlayerCharacter $playerCharacter): void
    {
        //
    }

    /**
     * Handle the PlayerCharacter "deleted" event.
     */
    public function deleted(PlayerCharacter $playerCharacter): void
    {
        //
    }

    /**
     * Handle the PlayerCharacter "restored" event.
     */
    public function restored(PlayerCharacter $playerCharacter): void
    {
        //
    }

    /**
     * Handle the PlayerCharacter "force deleted" event.
     */
    public function forceDeleted(PlayerCharacter $playerCharacter): void
    {
        //
    }
}
