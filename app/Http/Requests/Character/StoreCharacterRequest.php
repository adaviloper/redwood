<?php

namespace App\Http\Requests\Character;

use App\Enums\CharacterClasses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCharacterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'level' => ['required', 'numeric', 'min:1'],
            'strength' => ['required', 'int', 'max:20', 'min:1'],
            'constitution' => ['required', 'int', 'max:20', 'min:1'],
            'dexterity' => ['required', 'int', 'max:20', 'min:1'],
            'wisdom' => ['required', 'int', 'max:20', 'min:1'],
            'intelligence' => ['required', 'int', 'max:20', 'min:1'],
            'charisma' => ['required', 'int', 'max:20', 'min:1'],
            'class' => [Rule::in(CharacterClasses::values())],
        ];
    }
}
