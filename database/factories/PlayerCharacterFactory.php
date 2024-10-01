<?php

namespace Database\Factories;

use App\Models\Ability;
use App\Models\PlayerCharacter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlayerCharacter>
 */
class PlayerCharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maxHp = $this->faker->numberBetween(12, 16);
        return [
            'hp' => $this->faker->numberBetween(10, $maxHp),
            'max_hp' => $maxHp,
            'level' => 1,
        ];
    }

    // public function configure(): static
    // {
    //     return $this->afterMaking(function (PlayerCharacter $playerCharacter) {
    //             //
    //         })->afterCreating(function (PlayerCharacter $playerCharacter) {
    //             $playerCharacter->abilities()->saveMany([
    //                 Ability::factory()->strength()->make(),
    //                 Ability::factory()->constitution()->create(['player_character_id' => $playerCharacter->id]),
    //                 Ability::factory()->dexterity()->create(['player_character_id' => $playerCharacter->id]),
    //                 Ability::factory()->wisdom()->create(['player_character_id' => $playerCharacter->id]),
    //                 Ability::factory()->intelligence()->create(['player_character_id' => $playerCharacter->id]),
    //                 Ability::factory()->charisma()->create(['player_character_id' => $playerCharacter->id]),
    //             ]);
    //         });
    // }
}
