<?php

namespace App\Models;

use App\Models\PlayerCharacter;
use Database\Factories\AbilityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method AbilityFactory factory()
 */
class Ability extends Model
{
    use HasFactory;

    public $fillable = [
        'player_character_id',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(PlayerCharacter::class);
    }
}
