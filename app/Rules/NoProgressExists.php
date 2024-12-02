<?php

namespace App\Rules;

use App\Models\Roll;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class NoProgressExists implements DataAwareRule, ValidationRule
{
    protected  array $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->data['rolls'] as $roll) {
            $exists = Roll::query()->where([
                'user_id' => auth()->id(),
                'player_character_id' => $roll['player_character_id'],
                'scenario_step_id' => $roll['scenario_step_id'],
            ])->exists();

            if ($exists) {
                $fail("Rolls exists for step [{$roll['scenario_step_id']}]");
            }
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
