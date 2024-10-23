<?php

namespace Tests\Feature\Api\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $user;
    public function setUp() : void
    {
        parent::setUp();
        $this->user = User::firstWhere('email', 'alexszeliga@gmail.com');
    }

    public function testBasicSetUp() : void
    {
        $this->assertInstanceOf(User::class, $this->user);
    }

    public function testProfileContainsUserName() : void
    {
        $response = $this->actingAs($this->user)
                         ->get(route('user.profile'));
        $response->assertJsonPath('data.name', 'Alex Szeliga');
        $response->assertJsonPath('data.email', 'alexszeliga@gmail.com');
    }

    public function testAUserCanRegister() 
    {
        $this->assertDatabaseCount('users', 1);
        $response = $this->post(route('api.register'), [
            'name' => 'Dr Pepper',
            'email' => 'drpepper@gmail.com',
            'password' => 'password',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseCount('users', 2);

        $user = User::firstWhere('email', '=', 'drpepper@gmail.com');

        $this->assertEquals($user->getName(), 'Dr Pepper');
    }
}
