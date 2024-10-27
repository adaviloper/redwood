<?php

namespace App\Models;

use Database\Factories\RollFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static RollFactory factory()
 */
class Roll extends Model
{
    use HasFactory;

    public $fillable = [
        'ability',
        'scenario_step_id',
        'user_id',
        'player_character_id',
        'total',
    ];
}
