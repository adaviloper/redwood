<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('characters', CharacterController::class);
    Route::post('characters/select/{character}', [CharacterController::class, 'select'])->name('characters.select');
    Route::apiResource('inventory', ItemController::class);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
