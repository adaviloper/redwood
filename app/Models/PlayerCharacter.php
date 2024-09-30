<?php

namespace App\Models;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'user_id',
        'hp',
        'max_hp',
        'level',
    ];

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
