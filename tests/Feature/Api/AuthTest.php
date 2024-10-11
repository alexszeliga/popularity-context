<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testDefaultSuperAdminCanLogin(): void
    {
        $basicAuthB64 = base64_encode('alexszeliga@gmail.com:password');
        $response = $this->withHeaders(['Authorization' => "Basic $basicAuthB64"])
                         ->get('/api/login');

        $response->assertStatus(200);
    }
    public function testDefaultSuperAdminCannotLoginWithIncorrectPassword(): void
    {
        $basicAuthB64 = base64_encode('alexszeliga@gmail.com:wrong!');
        $response = $this->withHeaders(['Authorization' => "Basic $basicAuthB64"])
                         ->get('/api/login');

        $response->assertStatus(401);
    }
}
