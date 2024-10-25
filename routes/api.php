<?php

use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ScenarioController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\Daily\DailyAdventureController;
use App\Http\Controllers\PlayerCharacterController;
use App\Models\Scenario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('player-characters', PlayerCharacterController::class);
    Route::apiResource('inventory', ItemController::class);


    Route::prefix('admin')->group(function () {
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

    Route::apiResource('scenarios/daily', DailyAdventureController::class);
});

Route::middleware(['auth:sanctum'])->name('authenticated-user')->get('/user', function (Request $request) {
    /** @var User $user */
    $user = $request->user();
    $permissions = $user->getAllPermissions();

    $userResponse = $user->toArray();
    data_set($userResponse, 'permissions', $permissions);

    return response($userResponse);
});
