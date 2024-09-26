<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::apiResource('characters', CharacterController::class);
Route::apiResource('inventory', ItemController::class);

