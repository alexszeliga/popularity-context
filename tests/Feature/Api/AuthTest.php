<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthTest extends ApiTestCase
{
    protected $defaultUser, $basicAuthHeader;

    public function setUp() : void
    {
        parent::setUp();
        $this->defaultUser = User::firstWhere('email', 'alexszeliga@gmail.com');
        $basicAuthB64 = base64_encode('alexszeliga@gmail.com:password');
        $this->basicAuthHeader = ['Authorization' => "Basic $basicAuthB64"];
    }

    public function testDefaultSuperAdminCanLogin(): void
    {
        $response = $this->withHeaders($this->basicAuthHeader)
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

    public function testLoginResourceIncludesUserName(): void
    {
        $response =  $this->withHeaders($this->basicAuthHeader)
                          ->get('/api/login');
        $response->assertSee('Alex Szeliga');
    }
}
