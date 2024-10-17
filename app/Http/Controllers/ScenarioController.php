<?php

namespace App\Http\Controllers;

use App\Data\Scenario\StoreScenarioData;
use App\Http\Requests\Scenario\StoreScenarioRequest;
use App\Http\Requests\UpdateScenarioRequest;
use App\Models\Scenario;
use App\Services\ScenarioService;
use Illuminate\Http\Request;

class ScenarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'scenarios' => Scenario::query()->get()
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
            'scenario' => $scenario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScenarioRequest $request, Scenario $scenario)
    {
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
}
