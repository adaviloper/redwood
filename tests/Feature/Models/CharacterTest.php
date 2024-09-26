<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CharacterTest extends TestCase
{
    public function testAllCharactersCanBeRetrieved(): void
    {
        $response = $this->getJson('/characters');

        $response->assertStatus(200)
            ->content();
    }
}
