<?php

namespace Database\Seeders;

use App\Models\Scenario;
use App\Models\ScenarioStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScenarioStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scenarios = Scenario::query()->get();

        $scenarios->each(function (Scenario $scenario) {
            $optionA = ScenarioStep::factory()
                ->action()
                ->create([
                    'copy' => 'Option 2A',
                    'scenario_id' => $scenario->id,
                ]);
            $optionB = ScenarioStep::factory()
                ->action()
                ->create([
                    'copy' => 'Option 2B',
                    'scenario_id' => $scenario->id,
                ]);
            $step3 = ScenarioStep::factory()
                ->action()
                ->create([
                    'copy' => 'Step 3',
                    'scenario_id' => $scenario->id,
                ]);
            $step2 = ScenarioStep::factory()
                ->options([
                    [
                        'reference' => $optionA->id,
                    ],
                    [
                        'reference' => $optionB->id,
                    ],
                ])
                ->next($step3->id)
                ->create([
                    'copy' => 'Step 2',
                    'scenario_id' => $scenario->id,
                ]);
            $step1 = ScenarioStep::factory()
                ->action()
                ->next($step2->id)
                ->create([
                    'copy' => 'Step 1',
                    'scenario_id' => $scenario->id,
                ]);
        });
    }
}
