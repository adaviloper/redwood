<?php

namespace Tests\Feature\App\Http;

use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testCharactersCanBeFetched(): void
    {
        /** @var Collection $characters */
        $characters = Character::factory()->count(2)->create();
        $response = $this->getJson(route('characters.index'));

        $response->assertStatus(200)
            ->assertJsonFragment(
                CharacterResource::make($characters->first())->toArray($request),
            );
    }

    public function testAUserCanSelectACharacter(): void
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        /** @var Character $character */
        $character = Character::factory()->create();

        $this->postJson(route('characters.select', ['character' => $character->id]));

        $this->assertDatabaseHas('character_user', [
            'user_id' => $user->id,
            'character_id' => $character->id,
        ]);
    }
}
