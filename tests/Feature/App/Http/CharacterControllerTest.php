<?php

namespace Tests\Feature\App\Http;

use App\Models\Ability;
use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * A basic feature test example.
     */
    public function testCharactersCanBeFetched(): void
    {
        $this->withExceptionHandling();
        /** @var Character $character */
        $character = Character::factory()->create();
        $response = $this->getJson(route('characters.index'));

        $response->assertStatus(200)
            ->assertJson([
                'characters' => [$character->toArray()]
            ]);
    }
}
