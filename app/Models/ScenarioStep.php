<?php

namespace App\Models;

use App\Enums\StepTypes;
use Database\Factories\ScenarioStepFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $type
 * @property string $copy
 * @property string $scenario_step_id
 * @method ScenarioStepFactory factory()
 */
class ScenarioStep extends Model
{
    use HasFactory;
    use HasUuids;

    public $fillable = [
        'id',
        'type',
        'copy',
        'action',
        'options',
        'scenario_id',
        'scenario_step_id',
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
