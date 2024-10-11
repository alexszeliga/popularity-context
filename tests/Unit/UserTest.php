<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;


class UserTest extends TestCase
{
    public $superAdminRole;

    public function setUp() : void
    {
        parent::setUp();
        $this->superAdminRole = Role::findByName('super-admin');
    }

    public function testUserCanReturnRoles() 
    {
        $user = User::factory()->create();
        $user->assignRole('super-admin');
        $this->assertTrue($user->roles->contains($this->superAdminRole));
    }

    public function testDefaultUserExistsAndIsSuperAdmin(): void
    {
        $user = User::where('email', 'alexszeliga@gmail.com')->first();
        $this->assertTrue($user->name == "Alex Szeliga");
        $user->roles->contains($this->superAdminRole);
    }
}
