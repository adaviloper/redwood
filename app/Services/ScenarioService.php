<?php

namespace App\Services;

use App\Data\Scenario\StoreScenarioData;
use App\Models\Scenario;

class ScenarioService
{
    public function store(Scenario $scenario, StoreScenarioData $data): void
    {
        $scenario->steps()->createMany($data->steps->toArray());
    }
}
