<?php

namespace Database\Factories;

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
            'strength' => $this->faker->numberBetween(1, 20),
            'constitution' => $this->faker->numberBetween(1, 20),
            'dexterity' => $this->faker->numberBetween(1, 20),
            'wisdom' => $this->faker->numberBetween(1, 20),
            'intelligence' => $this->faker->numberBetween(1, 20),
            'charisma' => $this->faker->numberBetween(1, 20),
            'image_url' => $this->faker->imageUrl(400),
        ];
    }
}
