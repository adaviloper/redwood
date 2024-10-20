<?php

namespace Database\Factories;

use App\Enums\Abilities;
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
            'type' => StepTypes::STEP->value,
            'action' => [],
            'order' => $this->faker->numberBetween(1, 100),
            'copy' => $this->faker->sentence(4),
            'scenario_step_id' => $this->faker->uuid(),
        ];
    }

    public function action(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => StepTypes::STEP->value,
                'options' => null,
                'action' => [
                    'type' => 'roll',
                    'dice' => $this->faker->randomElement([
                        'd4',
                        'd6',
                        'd8',
                        'd10',
                        'd12',
                        'd20',
                    ]),
                    'ability' => $this->faker->randomElement(Abilities::values()),
                ],
            ];
        });
    }

    public function options(array $references): self
    {
        return $this->state(function (array $attributes) use ($references) {
            return [
                'action' => null,
                'type' => StepTypes::OPTION->value,
                'options' => $references,
            ];
        });
    }

    public function next(string $id): self
    {
        return $this->state(function (array $attributes) use ($id) {
            return [
                'scenario_step_id' => $id,
            ];
        });
    }

    public function terminalStep(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'scenario_step_id' => null,
            ];
        });
    }
}
