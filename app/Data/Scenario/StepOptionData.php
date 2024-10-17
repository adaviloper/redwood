<?php

namespace App\Data\Scenario;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class StepOptionData extends Data
{
    public function __construct(
        public readonly string $reference,
    )
    {
    }
}
