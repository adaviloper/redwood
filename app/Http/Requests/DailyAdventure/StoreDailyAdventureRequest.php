<?php

namespace App\Http\Requests\DailyAdventure;

use App\Enums\Abilities;
use App\Rules\NoProgressExists;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDailyAdventureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rolls.*.scenario_step_id' => [
                'required',
                'exists:scenario_steps,id',
                new NoProgressExists(),
            ],
            'rolls.*.player_character_id' => ['required', 'exists:player_characters,id'],
            'rolls.*.total' => ['required', 'numeric'],
            'rolls.*.ability' => ['required', Rule::in(Abilities::values())],
        ];
    }
}
