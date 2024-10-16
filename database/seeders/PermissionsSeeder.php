<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            'view-any-scenario',
            'view-scenario',
            'update-scenarios',
        ])->each(function (string $permissionName) {
                $permission = Permission::create([
                    'name' => $permissionName,
                ]);

                $permission->assignRole('admin');
            });
    }
}
