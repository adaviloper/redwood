<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scenario>
 */
class ScenarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->sentence(3, true),
            'narrative' => $this->faker->paragraphs(2, true),
        ];
    }

    public function today(): Factory
    {
        return $this->state(function () {
            return [
                'date' => today()->format('Y-m-d'),
            ];
        });
    }
}
