<?php

namespace Database\Factories;

use App\Enums\CharacterClasses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

    public function windChaser(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::WIND_CHASER->value,
            ];
        });
    }


    public function bladeDancer(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::BLADE_DANCER->value,
            ];
        });
    }

    public function shadowWeaver(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::SHADOW_WEAVER->value,
            ];
        });
    }

    public function lightSeeker(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::LIGHT_SEEKER->value,
            ];
        });
    }

    public function thornWeaver(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::THORN_WEAVER->value,
            ];
        });
    }

    public function spellKeeper(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'class' => CharacterClasses::SPELL_KEEPER->value,
            ];
        });
    }
}
