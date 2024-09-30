<?php

namespace Database\Factories;

use App\Enums\CharacterClasses;
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
            'name' => $this->faker->name,
            'class' => $this->faker->randomElement(CharacterClasses::values()),
            'image_url' => $this->faker->imageUrl(400),
            'description' => $this->faker->paragraph(),
        ];
    }
}

