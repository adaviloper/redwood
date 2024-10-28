<?php

namespace App\Models;

use App\Enums\Abilities;
use App\Models\Character;
use App\Models\User;
use App\Models\Classes\BladeDancer;
use App\Models\Classes\LightSeeker;
use App\Models\Classes\ShadowWeaver;
use App\Models\Classes\SpellKeeper;
use App\Models\Classes\ThornWeaver;
use App\Models\Classes\WindChaser;
use App\Observers\PlayerCharacterObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Exception;
use Illuminate\Support\Str;
use Parental\HasChildren;

/**
 * @property int $id
 * @property int $user_id
 * @property int $player_character_id
 * @property int $hp
 * @property int $max_hp
 * @property int $level
 */
#[ObservedBy(PlayerCharacterObserver::class)]
class PlayerCharacter extends Model implements NewPlayerContract
{
    use HasFactory;
    use HasChildren;

    protected $fillable = [
        'character_id',
        'user_id',
        'type',
        'hp',
        'max_hp',
        'level',
    ];

    protected $childTypes = [
        'blade-dancer' => BladeDancer::class,
        'light-seeker' => LightSeeker::class,
        'shadow-weaver' => ShadowWeaver::class,
        'spell-keeper' => SpellKeeper::class,
        'thorn-weaver' => ThornWeaver::class,
        'wind-chaser' => WindChaser::class,
        'default' => self::class,
    ];

    public function getChildClass(): PlayerCharacter
    {
        $class = $this->childTypes[Str::slug($this->character->class->value)];
        return new $class();
    }

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

    public function abilityValueFor(Abilities $ability): int
    {
        throw new Exception('Method [abilityValueFor] must be defined in [' . self::class . ']');
    }

    public function maxHealthAtLevel(int $level): int
    {
        throw new Exception('Method [maxHealthAtLevel] must be defined in [' . self::class . ']');
    }
}
