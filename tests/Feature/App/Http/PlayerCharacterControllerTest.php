<?php

namespace Tests\Feature\App\Http;

use App\Enums\Abilities;
use App\Models\Character;
use App\Models\PlayerCharacter;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
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

    public function testCreatedPlayerCharactersCanBeFetched(): void
    {
        /** @var Character $characterA */
        $characterA = Character::factory()->windChaser()->create();
        /** @var Character $characterB */
        $characterB = Character::factory()->thornWeaver()->create();
        $playerCharacterA = PlayerCharacter::factory()->create([
            'user_id' => $this->user->id,
            'character_id' => $characterA->id,
        ]);
        $playerCharacterB = PlayerCharacter::factory()->create([
            'user_id' => $this->user->id,
            'character_id' => $characterB->id,
        ]);

        $response = $this->getJson(route('player-characters.index'));

        $this->assertCount(2, $response->json('player_characters'));
        $this->assertCount(6, $response->json('player_characters.0.abilities'));
        $this->assertCount(6, $response->json('player_characters.1.abilities'));
    }

    public function testAUserCanSelectACharacter(): void
    {
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

    public function testAPlayerCharacterIsReturnedWithRelevantData(): void
    {
        /** @var Character $character */
        $character = Character::factory()->create();

        $response = $this->postJson(route('player-characters.store'), [
            'character_id' => $character->id
        ]);

        /** @var PlayerCharacter $pc */
        $pc = $this->user->characters()->first();

        $abilities = $response->json('player_character.abilities');
        $response->assertJsonFragment([
            'character' => $character->toArray(),
            'abilities' => $pc->abilities->toArray(),
        ]);

    }

    public function testCreatingACharacterStartsOutAtLevelOne(): void
    {
        $character = Character::factory()->create();

        $this->postJson(route('player-characters.store'), [
            'character_id' => $character->id,
        ]);

        $this->assertDatabaseHas('player_characters', [
            'user_id' => $this->user->id,
            'character_id' => $character->id,
            'level' => 1,
        ]);
    }

    public function testCreatingACharacterCreatesAllSixAbilityScoreRecords(): void
    {
        $character = Character::factory()->create();

        $response = $this->postJson(route('player-characters.store'), [
            'character_id' => $character->id,
        ]);

        $this->assertCount(6, $response->json('player_character.abilities'));
    }

    public static function provideBaseAbilityScores(): array
    {
        return [
            'wind-chaser' => [
                'windChaser',
                [
                    Abilities::STRENGTH->value => 0,
                    Abilities::DEXTERITY->value => 3,
                    Abilities::CONSTITUTION->value => 1,
                    Abilities::INTELLIGENCE->value => -2,
                    Abilities::WISDOM->value => 0,
                    Abilities::CHARISMA->value => -2,
                ]
            ],
            'thorn-weaver' => [
                'thornWeaver',
                [
                    Abilities::STRENGTH->value => 0,
                    Abilities::DEXTERITY->value => 2,
                    Abilities::CONSTITUTION->value => -2,
                    Abilities::INTELLIGENCE->value => 2,
                    Abilities::WISDOM->value => -2,
                    Abilities::CHARISMA->value => 0,
                ]
            ],
            'spell-keeper' => [
                'spellKeeper',
                [
                    Abilities::STRENGTH->value => -1,
                    Abilities::DEXTERITY->value => -1,
                    Abilities::CONSTITUTION->value => -1,
                    Abilities::INTELLIGENCE->value => 2,
                    Abilities::WISDOM->value => 2,
                    Abilities::CHARISMA->value => -1,
                ]
            ],
            'blade-dancer' => [
                'bladeDancer',
                [
                    Abilities::STRENGTH->value => 0,
                    Abilities::DEXTERITY->value => 2,
                    Abilities::CONSTITUTION->value => -2,
                    Abilities::INTELLIGENCE->value => -1,
                    Abilities::WISDOM->value => -1,
                    Abilities::CHARISMA->value => 2,
                ]
            ],
            'shadow-weaver' => [
                'shadowWeaver',
                [
                    Abilities::STRENGTH->value => -1,
                    Abilities::DEXTERITY->value => 1,
                    Abilities::CONSTITUTION->value => 2,
                    Abilities::INTELLIGENCE->value => -2,
                    Abilities::WISDOM->value => -1,
                    Abilities::CHARISMA->value => 1,
                ]
            ],
            'light-seeker' => [
                'lightSeeker',
                [
                    Abilities::STRENGTH->value => 2,
                    Abilities::DEXTERITY->value => 1,
                    Abilities::CONSTITUTION->value => 0,
                    Abilities::INTELLIGENCE->value => -1,
                    Abilities::WISDOM->value => -1,
                    Abilities::CHARISMA->value => -1,
                ]
            ],
        ];
    }

    /**
     * @param array<int,mixed> $expectedValues
     */
    #[DataProvider('provideBaseAbilityScores')]
    public function testBaseStatsAreSetOnPlayerCharacterCreation(string $class, array $expectedValues): void
    {
        $character = Character::factory()->{$class}()->create();

        $response = $this->postJson(route('player-characters.store'), [
            'character_id' => $character->id,
        ]);

        $abilities = $response->json('player_character.abilities');

        foreach ($abilities as $ability) {
            $this->assertEquals($expectedValues[$ability['name']], $ability['value']);
        }
    }
}
