<?php

namespace App\Data\Scenario;

use App\Data\Scenario\StepActionData;
use App\Data\Scenario\StepOptionData;
use App\Enums\StepTypes;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ScenarioStepData extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly StepTypes $type,
        public readonly string $copy,
        /** @var Collection<int, StepOptionData> $options  */
        public readonly ?Collection $options,
        public readonly ?StepActionData $action,
        public readonly ?string $scenarioStepId,
    )
    {
    }
}
