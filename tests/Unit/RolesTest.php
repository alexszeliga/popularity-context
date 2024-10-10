<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;


class RolesTest extends TestCase
{
    public function testSuperAdminRoleIsAssignable(): void
    {
        $user = User::factory()->create();
        $user->assignRole('super-admin');
        // $superAdminRole = Role::where('name', 'super-admin')->sole();
    }
}
