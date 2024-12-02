<?php

namespace Database\Factories;

use App\Enums\Abilities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roll>
 */
class RollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->numberBetween(1, 20),
            'scenario_step_id' => $this->faker->uuid(),
            'ability' => $this->faker->randomElement(Abilities::values()),
            'die_result' => $this->faker->numberBetween(1, 20),
        ];
    }
}
