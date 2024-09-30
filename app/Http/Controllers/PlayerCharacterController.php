<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerCharacter\StorePlayerCharacterRequest;
use App\Models\PlayerCharacter;
use Illuminate\Http\Request;

class PlayerCharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerCharacterRequest $request)
    {
        $playerCharacter = PlayerCharacter::query()->create([
            'user_id' => $request->user()->id,
            'character_id' => $request->character_id,
            'hp' => 10,
            'max_hp' => 10,
            'level' => 1,
        ]);

        return response([
            'character' => $playerCharacter->load(['character', 'abilities'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlayerCharacter $playerCharacter)
    {
        return response([
            'character' => $playerCharacter->load('character'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlayerCharacter $playerCharacter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayerCharacter $playerCharacter)
    {
        //
    }
}
