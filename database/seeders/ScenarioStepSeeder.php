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
            $step3 = ScenarioStep::factory()
                ->action()
                ->terminalStep()
                ->make([
                    // 'copy' => 'Step 3',
                    'order' => 5,
                    'scenario_id' => $scenario->id,
                ]);
            $optionA = ScenarioStep::factory()
                ->action()
                ->terminalStep()
                ->make([
                    'copy' => 'Option 2A',
                    'order' => 3,
                    'scenario_id' => $scenario->id,
                ]);
            $optionB = ScenarioStep::factory()
                ->action()
                ->terminalStep()
                ->make([
                    // 'copy' => 'Option 2B',
                    'order' => 4,
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
                ->make([
                    // 'copy' => 'Step 2',
                    'order' => 2,
                    'scenario_id' => $scenario->id,
                ]);
            $step1 = ScenarioStep::factory()
                ->action()
                ->next($step2->id)
                ->make([
                    // 'copy' => 'Step 1',
                    'order' => 1,
                    'scenario_id' => $scenario->id,
                ]);
            $step1->save();
            $step2->save();
            $optionA->save();
            $optionB->save();
            $step3->save();
        });
    }
}
