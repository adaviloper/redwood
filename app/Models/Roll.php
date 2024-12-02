<?php

namespace App\Models;

use Database\Factories\RollFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static RollFactory factory()
 */
class Roll extends Model
{
    use HasFactory;

    public $fillable = [
        'ability',
        'die_result',
        'player_character_id',
        'scenario_step_id',
        'total',
        'user_id',
    ];

    public function scenarioStep(): BelongsTo
    {
        return $this->belongsTo(ScenarioStep::class);
    }
}
