<?php

namespace Tests\Feature\App\Http;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testCharactersCanBeFetched(): void
    {
        /** @var Character $characters */
        $characters = Character::factory()->count(2)->create();
        $response = $this->getJson(route('characters.index'));

        $response->assertStatus(200)
            ->assertJson($characters->toArray());
    }
}
