<?php

namespace App\Models;

use Database\Factories\RollFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method RollFactory factory()
 */
class Roll extends Model
{
    use HasFactory;

    public $fillable = [
        'ability',
        'scenario_step_id',
        'user_id',
        'total',
    ];
}
