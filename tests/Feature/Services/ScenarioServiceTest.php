<?php

namespace Tests\Feature\Services;

use App\Data\Scenario\StoreScenarioData;
use App\Enums\StepTypes;
use App\Models\Scenario;
use App\Models\ScenarioStep;
use App\Services\ScenarioService;
use GuzzleHttp\Utils;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScenarioServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testScenarioServiceCanStoreAScenariosRelationship(): void
    {
        $this->withoutExceptionHandling();
        /** @var ScenarioStep $step */
        $step = ScenarioStep::factory()->make();
        /** @var Scenario $scenario */
        $scenario = Scenario::factory()->create();
        $scenario->steps = [$step];
        $scenarioService = new ScenarioService();

        $scenarioService->store($scenario, StoreScenarioData::validateAndCreate([
            'steps' => [
                [
                    'id' => 'f0fdee38-8a6c-42bd-8007-d8bdb18b7f51',
                    'type' => $step->type,
                    'copy' => $step->copy,
                    'scenario_step_id' => $step->scenario_step_id,
                ]
            ],
        ]));

        $this->assertDatabaseHas('scenario_steps', [
            'type' => $step->type->value,
            'copy' => $step->copy,
            'scenario_id' => $scenario->id,
            'scenario_step_id' => $step->scenario_step_id,
        ]);
    }

    public function testActionStepsCanBeStored(): void
    {
        $this->withoutExceptionHandling();
        /** @var Scenario $scenario */
        $scenario = Scenario::factory()->create();
        $scenarioService = new ScenarioService();
        $scenarioData = Utils::jsonDecode(file_get_contents(base_path('tests/Stubs/scenario-create-data.json')), true);
        $data = StoreScenarioData::validateAndCreate([
            'steps' => $scenarioData['steps']
        ]);

        $scenarioService->store(
            $scenario,
            $data
        );

        $this->assertDatabaseHas('scenario_steps', [
            'type' => StepTypes::STEP->value,
            'copy' => 'Step 1',
            'action' => Utils::jsonEncode([
                'type' => 'roll',
                'dice' => 'd20',
                'ability' => 'strength',
            ])
        ]);
        $this->assertEquals(4, $scenario->steps()->where('type', StepTypes::STEP->value)->count());
        $this->assertEquals(5, $scenario->steps()->count());
    }

    public function testOptionStepsCanBeStored(): void
    {
        $this->withoutExceptionHandling();
        /** @var Scenario $scenario */
        $scenario = Scenario::factory()->create();
        $scenarioService = new ScenarioService();
        $scenarioData = Utils::jsonDecode(file_get_contents(base_path('tests/Stubs/scenario-create-data.json')), true);
        $data = StoreScenarioData::validateAndCreate([
            'steps' => $scenarioData['steps']
        ]);

        $scenarioService->store(
            $scenario,
            $data
        );

        $this->assertDatabaseHas('scenario_steps', [
            'type' => StepTypes::STEP->value,
            'copy' => 'Step 1',
            'action' => Utils::jsonEncode([
                'type' => 'roll',
                'dice' => 'd20',
                'ability' => 'strength',
            ])
        ]);
        $this->assertEquals(5, $scenario->steps()->count());
        $this->assertEquals(1, $scenario->steps()->where('type', StepTypes::OPTION->value)->count());
    }
}
