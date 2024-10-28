<?php

namespace App\Models;

use App\Enums\StepTypes;
use Database\Factories\ScenarioStepFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property        string              $id
 * @property        StepTypes           $type
 * @property        string              $copy
 * @property        string              $scenario_step_id
 * @method   static ScenarioStepFactory factory()
 */
class ScenarioStep extends Model
{
    use HasFactory;
    use HasUuids;

    public $fillable = [
        'action',
        'copy',
        'id',
        'options',
        'order',
        'scenario_id',
        'scenario_step_id',
        'type',
    ];

    public $casts = [
        'action' => 'json',
        'options' => 'json',
        'type' => StepTypes::class,
    ];

    public function scenario(): BelongsTo
    {
        return $this->belongsTo(Scenario::class);
    }
}
