<?php

namespace Tests\Unit\Models;

use App\Enums\CharacterClasses;
use App\Models\Character;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('character')]
class CharacterTest extends TestCase
{
    public function testCharacterClassGetsCastToEnum(): void
    {
        $character = Character::factory()
            ->windChaser()
            ->make()
        ;

        $this->assertInstanceOf(CharacterClasses::class, $character->class);
    }
}
