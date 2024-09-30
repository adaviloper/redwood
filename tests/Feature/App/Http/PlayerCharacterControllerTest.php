<?php

namespace Tests\Feature\App\Http;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerCharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testAUserCanSelectACharacter(): void
    {
        $this->withoutExceptionHandling();
        /** @var Character $character */
        $character = Character::factory()->create();

        $response = $this->postJson(route('player-characters.store'), [
            'character_id' => $character->id
        ]);

        $this->assertDatabaseHas('player_characters', [
            'user_id' => $this->user->id,
            'character_id' => $character->id,
        ]);
        $response->assertJsonFragment([
            'character' => $character->toArray(),
        ]);
    }
}
