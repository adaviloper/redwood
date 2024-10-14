<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsFetchedWithRelationships(): void
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'view-any-scenarios']);
        $permission->assignRole($role);
        /** @var User $user */
        $user = User::factory()->create();
        $user->assignRole($role);
        $this->actingAs($user);

        $response = $this->getJson(route('authenticated-user'));
        $permissions = collect($response->json('all_permissions'))->pluck('name');

        $this->assertContains('view-any-scenarios', $permissions);
    }
}
