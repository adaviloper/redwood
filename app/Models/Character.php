<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $class
 * @property int $level
 * @property int $strength
 * @property int $constitution
 * @property int $dexterity
 * @property int $wisdom
 * @property int $intelligence
 * @property int $charisma
 * @property string $image_url
 */
class Character extends Model
{
    use HasFactory;

    public function stats(): array
    {
        return [
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
        ];
    }
}
