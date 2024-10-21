<?php

namespace Database\Seeders;

use App\Models\Scenario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScenarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = today()->subDays(10);
        for ($i = 0; $i < 50; $i++) {
            Scenario::factory()->create([
                'date' => $date->format('Y-m-d'),
            ]);
            $date = $date->addDay();
        }
    }
}
