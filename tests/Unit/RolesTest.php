<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTest extends TestCase
{
    public function testSuperAdminHasAllPermissions(): void
    {
        $allPermissions = Permission::all()->pluck('name');
        $user = User::factory()->create();
        $this->assertFalse($user->hasAnyPermission($allPermissions));
        $user->assignRole('super-admin');
        $this->assertTrue($user->hasAllPermissions($allPermissions));
    }
}
