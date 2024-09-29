<?php

namespace App\Models;

use App\Models\Ability;
use App\Models\User;
use Database\Factories\CharacterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @method CharacterFactory factory()
 */
class Character extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
