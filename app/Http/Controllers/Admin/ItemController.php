<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::query()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Item::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $inventory)
    {
        return $inventory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $inventory)
    {
        return $inventory->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $inventory)
    {
        return $inventory->delete();
    }
}
