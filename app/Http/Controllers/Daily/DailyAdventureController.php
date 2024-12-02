<?php

namespace App\Http\Controllers\Daily;

use App\Http\Controllers\Controller;
use App\Http\Requests\DailyAdventure\StoreDailyAdventureRequest;
use App\Models\Roll;
use App\Models\Scenario;
use Illuminate\Http\Request;

class DailyAdventureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $playerCharacterId = $request->input('player_character_id');
        $scenarios = Scenario::query()
                ->available()
                ->orderBy('date', 'desc')
                ->with([
                    'steps'
                ])
                ->get();
        $progress = Roll::query()
            ->where([
                'player_character_id' => $playerCharacterId,
                'user_id' => auth()->id(),
            ])
            ->with('scenarioStep')
            ->get()
            ->groupBy('scenarioStep.scenario_id');
        $progress->each(function ($rolls, $scenarioId) use ($scenarios) {
            $scenarios->where('id', $scenarioId)
                ->first()
                ?->setAttribute('complete', true);
        });

        return response([
            'scenarios' => $scenarios,
            'rolls' => $progress,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyAdventureRequest $request)
    {
        foreach ($request->input('rolls', []) as $roll) {
            $roll['user_id'] = $request->user()->id;
            Roll::query()->create($roll);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Scenario $scenario)
    {
        return response([
            'scenario' => $scenario->load('steps'),
            // 'progress' =>
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scenario $scenario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scenario $scenario)
    {
        //
    }
}
