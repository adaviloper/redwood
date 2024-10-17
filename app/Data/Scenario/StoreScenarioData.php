<?php

namespace App\Data\Scenario;

use App\Data\Scenario\ScenarioStepData;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class StoreScenarioData extends Data
{
    public function __construct(
        /** @var Collection<int, ScenarioStepData> $steps  */
        public readonly Collection $steps,
    )
    {
    }
}
