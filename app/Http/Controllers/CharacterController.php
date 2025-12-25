<?php

namespace App\Http\Controllers;

use App\Http\Requests\Character\StoreCharacterRequest;
use App\Http\Requests\Character\UpdateCharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'characters' => CharacterResource::collection(
                QueryBuilder::for(Character::class)
                    ->allowedFilters(['class'])
                    ->get()
            ),
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharacterRequest $request)
    {
        return Character::query()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return $character;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharacterRequest $request, Character $character)
    {
        return $character->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        return $character->delete();
    }
}
