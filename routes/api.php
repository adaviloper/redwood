<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlayerCharacterController;
use App\Http\Controllers\ScenarioController;
use App\Models\Scenario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('player-characters', PlayerCharacterController::class);
    Route::apiResource('inventory', ItemController::class);


    Route::get('scenarios', [ScenarioController::class, 'index'])
        ->name('scenarios.index')
        ->can('viewAny', Scenario::class);
    Route::get('scenarios/{scenario}', [ScenarioController::class, 'show'])
        ->name('scenarios.show')
        ->can('view', 'scenario');
    Route::post('scenarios', [ScenarioController::class, 'store'])
        ->name('scenarios.store')
        ->can('create', Scenario::class);
    Route::put('scenarios/{scenario}', [ScenarioController::class, 'update'])
        ->name('scenarios.update')
        ->can('update', 'scenario');
    Route::delete('scenarios/{scenario}', [ScenarioController::class, 'destroy'])
        ->name('scenarios.destroy')
        ->can('delete', 'scenario');
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response($request->user());
});
