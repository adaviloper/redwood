<?php

namespace App\Models;

use App\Enums\StepTypes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $copy
 * @property string $scenario_step_id
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
        'scenario_id',
        'scenario_step_id',
    ];

    public $casts = [
        'action' => 'json',
        'type' => StepTypes::class,
    ];
}
