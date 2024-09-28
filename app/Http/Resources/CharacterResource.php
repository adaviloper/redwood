<?php

namespace App\Http\Resources;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public $collection = Character::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'class' => $this->class,
            'imageUrl' => $this->image_url,
            'stats' => [
                [
                    'name' => 'strength',
                    'type' => 'physical',
                    'value' => $this->strength,
                ],
                [
                    'name' => 'constitution',
                    'type' => 'physical',
                    'value' => $this->constitution,
                ],
                [
                    'name' => 'dexterity',
                    'type' => 'physical',
                    'value' => $this->dexterity,
                ],
                [
                    'name' => 'wisdom',
                    'type' => 'mental',
                    'value' => $this->wisdom,
                ],
                [
                    'name' => 'intelligence',
                    'type' => 'mental',
                    'value' => $this->intelligence,
                ],
                [
                    'name' => 'charisma',
                    'type' => 'mental',
                    'value' => $this->charisma,
                ],
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
