<?php

namespace Tests\Feature\App\Http\Admin;

use App\Models\Scenario;
use App\Models\ScenarioStep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ScenariosControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testAdminUsersCanViewAllScenarios(): void
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'view-any-scenario']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->assignRole('admin');
        $scenarios = Scenario::factory()->count(2)->create();

        $response = $this->getJson(route('scenarios.index'));

        $response->assertJsonCount(2, 'scenarios');
    }

    public function testAdminUsersCanViewAScenario(): void
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'view-scenario']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->assignRole('admin');
        $scenario = Scenario::factory()->create();

        $response = $this->getJson(route('scenarios.show', ['scenario' => $scenario]));

        $response->assertJson([
            'scenario' => $scenario->toArray(),
        ]);
    }

    public function testAdminUsersCanStoreAScenario(): void
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'create-scenarios']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->assignRole('admin');
        /** @var ScenarioStep $step */
        $step = ScenarioStep::factory()->action()->make();
        /** @var Scenario $scenario */
        $scenario = Scenario::factory()->make();
        $scenario->steps = [$step];

        $response = $this->postJson(route('scenarios.store'), $scenario->toArray());

        $this->assertDatabaseHas('scenarios', [
            'date' => $scenario->date,
            'narrative' => $scenario->narrative,
        ]);
    }

    public function testAdminUsersCanUpdateAScenario(): void
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'update-scenarios']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->assignRole('admin');
        $scenario = Scenario::factory()->create();

        $response = $this->putJson(route('scenarios.update', ['scenario' => $scenario]), [
            'narrative' => 'updated text',
            'steps' => [],
        ]);

        $this->assertDatabaseHas('scenarios', [
            'id' => $scenario->id,
            'narrative' => 'updated text',
        ]);
    }

    public function testAdminUsersCanDeleteAScenario(): void
    {
        $this->withoutExceptionHandling();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'delete-scenarios']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user = User::factory()->create();
        $this->actingAs($user);
        $user->assignRole('admin');
        /** @var Scenario $scenario */
        $scenario = Scenario::factory()->create();

        $response = $this->deleteJson(route('scenarios.destroy', ['scenario' => $scenario]));

        $this->assertDatabaseMissing('scenarios', [
            'id' => $scenario->id,
            'narrative' => $scenario->narrative,
        ]);
    }
}
