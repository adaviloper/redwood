<?php

namespace App\Http\Controllers\Admin;

use App\Data\Scenario\Admin\StoreScenarioData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Scenario\Admin\StoreScenarioRequest;
use App\Http\Requests\UpdateScenarioRequest;
use App\Models\Scenario;
use App\Services\ScenarioService;

class ScenarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'scenarios' => Scenario::query()->with('steps')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScenarioRequest $request, ScenarioService $scenarioService)
    {
        $scenario = Scenario::query()->create(
            $request->only(['narrative', 'date'])
        );
        $scenarioService->store($scenario, StoreScenarioData::validateAndCreate([
            'steps' => $request->input('steps'),
        ]));
        return $scenario;
    }

    /**
     * Display the specified resource.
     */
    public function show(Scenario $scenario)
    {
        return response()->json([
            'scenario' => $scenario->load('steps'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScenarioRequest $request, Scenario $scenario, ScenarioService $scenarioService)
    {
        $scenarioService->update($scenario, StoreScenarioData::validateAndCreate([
            'steps' => $request->input('steps'),
        ]));
        $scenario->update($request->validated());
        return $scenario;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scenario $scenario)
    {
        return $scenario->delete();
    }

    public function daily()
    {
        return response([
            'scenario' => Scenario::query()
                ->with('steps')
                ->where('date', today()->format('Y-m-d'))
                ->first(),
        ]);
    }
}
