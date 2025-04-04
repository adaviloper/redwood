<?php

namespace App\Models;

use App\Models\ScenarioStep;
use Database\Factories\ScenarioFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property        string          $id
 * @property        string          $date
 * @property        string          $narrative
 *
 * @method   static ScenarioFactory factory()
 *
 * @method Builder available()
 */
class Scenario extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'date',
        'narrative',
    ];

    public function getRouteKeyName(): string
    {
        return 'date';
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ScenarioStep::class)->orderBy('order', 'asc');
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('date', '<=',today()->format('Y-m-d'));
    }
}

