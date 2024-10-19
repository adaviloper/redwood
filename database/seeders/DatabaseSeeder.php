<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        /** @var User $user */
        $user = User::factory()->create([
            'username' => 'user',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('admin');

        $this->call(ItemSeeder::class);
        $this->call(CharacterSeeder::class);
        $this->call(ScenarioSeeder::class);
        $this->call(ScenarioStepSeeder::class);
    }
}
