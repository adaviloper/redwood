<?php

namespace Database\Seeders;

use App\Enums\CharacterClasses;
use App\Models\Character;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::factory()->create([
            'name' => 'Tak Redwind',
            'class' => CharacterClasses::WIND_CHASER,
        ]);
        Character::factory()->create([
            'name' => 'Thatch Springwillow',
            'class' => CharacterClasses::THORN_WEAVER,
        ]);
        Character::factory()->create([
            'name' => 'Quill Mudsong',
            'class' => CharacterClasses::SPELL_KEEPER,
        ]);
        Character::factory()->create([
            'name' => 'Cora Wildclaw',
            'class' => CharacterClasses::BLADE_DANCER,
        ]);
        Character::factory()->create([
            'name' => 'Merrik Lightfoot',
            'class' => CharacterClasses::SHADOW_WEAVER,
        ]);
        Character::factory()->create([
            'name' => 'Sil Blackbolt',
            'class' => CharacterClasses::LIGHT_SEEKER,
        ]);
    }
}
