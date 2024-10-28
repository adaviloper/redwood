<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerCharacter\StorePlayerCharacterRequest;
use App\Models\Character;
use App\Models\PlayerCharacter;
use Illuminate\Http\Request;

class PlayerCharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response([
            'player_characters' => PlayerCharacter::query()
                ->where('user_id', $request->user()->id)
                ->with(['character', 'abilities'])
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerCharacterRequest $request)
    {
        $character = Character::query()->find($request->input('character_id'));
        $playerCharacter = PlayerCharacter::query()->create([
            'user_id' => $request->user()->id,
            'character_id' => $request->character_id,
            'type' => $character->class->slug(),
            'hp' => 10,
            'max_hp' => 10,
            'level' => 1,
        ]);

        return response([
            'player_character' => $playerCharacter->load([
                'abilities',
                'character',
            ]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlayerCharacter $playerCharacter)
    {
        return response([
            'player_character' => $playerCharacter->load(['abilities', 'character']),
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
