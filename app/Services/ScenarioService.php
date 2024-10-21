<?php

namespace App\Services;

use App\Data\Scenario\Admin\StoreScenarioData;
use App\Models\Scenario;

class ScenarioService
{
    public function store(Scenario $scenario, StoreScenarioData $data): void
    {
        $scenario->steps()->createMany($data->steps->toArray());
    }

    public function update(Scenario $scenario, StoreScenarioData $data): void
    {
        $scenario->steps()->delete();
        $scenario->steps()->createMany($data->steps->toArray());
    }
}
