<?php

namespace App\Models;

use App\Enums\CharacterClasses;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property CharacterClasses $class
 * @property int $level
 * @property int $strength
 * @property int $constitution
 * @property int $dexterity
 * @property int $wisdom
 * @property int $intelligence
 * @property int $charisma
 * @property string $image_url
 * @property string $description
 *
 * @method CharacterFactory factory()
 */
class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
        'image_url',
        'description',
    ];

    protected $casts = [
        'class' => CharacterClasses::class,
    ];
}
