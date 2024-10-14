<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $date
 * @property string $narrative
 */
class Scenario extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'narrative',
    ];
}
