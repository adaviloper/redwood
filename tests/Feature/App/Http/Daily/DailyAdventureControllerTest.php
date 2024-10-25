<?php

namespace Tests\Feature\App\Http\Daily;

use App\Models\Roll;
use App\Models\Scenario;
use App\Models\ScenarioStep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DailyAdventureControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDailyAdventureScenarioCanBeRetrieved(): void
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $scenario = Scenario::factory()->today()->create();
        $step = ScenarioStep::factory()->create(['scenario_id' => $scenario->id]);

        $response = $this->getJson(route('daily.index'));

        $response->assertJsonStructure([
            'scenario' => [
                'steps' => [
                    [
                        'type'
                    ]
                ]
            ]
        ]);
    }

    public function testDailAdventureScenarioPullsTodaysScenario(): void
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $yesterdaysScenario = Scenario::factory()->create([
            'date' => today()->subDay()->format('Y-m-d'),
        ]);
        $todaysScenario = Scenario::factory()->create([
            'date' => today()->format('Y-m-d'),
        ]);
        $step = ScenarioStep::factory()->create(['scenario_id' => $todaysScenario->id]);

        $response = $this->getJson(route('daily.index'));

        $response->assertJsonStructure([
            'scenario' => [
                'steps' => [
                    [
                        'type'
                    ]
                ]
            ]
        ]);
        $this->assertEquals(today()->format('Y-m-d'), $response->json('scenario.date'));
    }

    public function testRollResultsCanBeSavedForAScenario(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $scenario = Scenario::factory()->today()->create();
        $step1 = ScenarioStep::factory()->create(['scenario_id' => $scenario->id]);
        $step2 = ScenarioStep::factory()->create(['scenario_id' => $scenario->id]);
        $roll1 = Roll::factory()->make(['scenario_step_id' => $step1->id]);
        $roll2 = Roll::factory()->make(['scenario_step_id' => $step2->id]);

        $this->postJson(route('daily.store'), [
            'rolls' => [
                $roll1->toArray(),
                $roll2->toArray(),
            ]
        ]);

        $this->assertDatabaseHas('rolls', [
            'scenario_step_id' => $step1->id,
            'total' => $roll1->total,
            'ability' => $roll1->ability,
            'user_id' => $user->id,
        ]);
    }
}
