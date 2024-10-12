<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthTest extends ApiTestCase
{
    protected $defaultUser;

    public function setUp() : void
    {
        parent::setUp();
        $this->defaultUser = User::firstWhere('email', 'alexszeliga@gmail.com');
    }

    public function testDefaultSuperAdminCanLogin(): void
    {
        $basicAuthB64 = base64_encode('alexszeliga@gmail.com:password');
        $response = $this->withHeaders(['Authorization' => "Basic $basicAuthB64"])
                         ->get('/api/login');
        $response->assertStatus(200);
        $response->assertSeeText('token');
        $this->defaultUser->tokens->each(function($t) use ($response) {
            $response->assertSeeText( ( $t->plainTextToken ) );
        });
    }

    public function testDefaultSuperAdminCannotLoginWithIncorrectPassword(): void
    {
        $basicAuthB64 = base64_encode('alexszeliga@gmail.com:wrong!');
        $response = $this->withHeaders(['Authorization' => "Basic $basicAuthB64"])
                         ->get('/api/login');

        $response->assertStatus(401);
        $response->assertSee('Invalid credentials.');
    }

    public function testLoginRequiresBasicAuth() : void
    {
        $response = $this->get('/api/login');
        $response->assertStatus(401);
        $response->assertSee('Invalid credentials.');
    }
}
