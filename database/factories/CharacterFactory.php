<?php

namespace Database\Factories;

use App\Models\Ability;
use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'class' => $this->faker->randomElement(['Ranger', 'Fighter', 'Druid', 'Monk', 'Cleric', 'Paladin', 'Barbarian']),
            'level' => 1,
            'image_url' => $this->faker->imageUrl(400),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Character $character) {
                //
            })->afterCreating(function (Character $character) {
                $character->abilities()->saveMany([
                    Ability::factory()->strength()->make(),
                    Ability::factory()->constitution()->create(['character_id' => $character->id]),
                    Ability::factory()->dexterity()->create(['character_id' => $character->id]),
                    Ability::factory()->wisdom()->create(['character_id' => $character->id]),
                    Ability::factory()->intelligence()->create(['character_id' => $character->id]),
                    Ability::factory()->charisma()->create(['character_id' => $character->id]),
                ]);
            });
    }

    public function forUser(User $user): Factory
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }
}
