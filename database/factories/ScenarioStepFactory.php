<?php

namespace Database\Factories;

use App\Enums\StepTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScenarioStep>
 */
class ScenarioStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'type' => StepTypes::STEP,
            'copy' => $this->faker->sentence(4),
            'scenario_step_id' => $this->faker->uuid(),
        ];
    }
}
