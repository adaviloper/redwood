<?php

namespace Database\Seeders;

use App\Models\Roll;
use App\Models\Scenario;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        $step = Scenario::query()->first();
        Roll::query()->create([
            'user_id' => $user->id,
            'player_character_id' => 1,
            'scenario_step_id' => $step->id,
        ]);
    }
}
