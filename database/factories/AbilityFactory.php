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
            'value' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function strength(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::STRENGTH->value,
                'type' => 'physical',
            ];
        });
    }

    public function constitution(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::CONSTITUTION->value,
                'type' => 'physical',
            ];
        });
    }

    public function dexterity(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::STRENGTH->value,
                'type' => 'physical',
            ];
        });
    }

    public function wisdom(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::WISDOM->value,
                'type' => 'mental',
            ];
        });
    }

    public function intelligence(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::INTELLIGENCE->value,
                'type' => 'mental',
            ];
        });
    }

    public function charisma(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => Abilities::INTELLIGENCE->value,
                'type' => 'mental',
            ];
        });
    }
}
