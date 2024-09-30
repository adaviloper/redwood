<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlayerCharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('characters', CharacterController::class);
    Route::apiResource('player-characters', PlayerCharacterController::class);
    Route::apiResource('inventory', ItemController::class);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response($request->user());
});
