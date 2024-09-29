<?php

namespace Database\Factories;

use App\Enums\Abilities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ability>
 */
class AbilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(Abilities::values()),
            'type' => $this->faker->randomElement(['mental', 'physical']),
        ];
    }
}
