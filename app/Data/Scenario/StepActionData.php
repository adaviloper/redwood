<?php

namespace App\Data\Scenario;

use Spatie\LaravelData\Data;

class StepActionData extends Data
{
    public function __construct(
        public readonly string $type,
        public readonly string $dice,
        public readonly string $ability,
    ) {}
}
