<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Client;
use App\Models\User;

class ClientTest extends TestCase
{
    protected $client;

    public function setUp() : void
    {
        parent::setUp();
        $this->client = Client::factory()->create([
            'scheme' => 'http',
            'hostname' => 'examplehostname',
        ]);
    }

    public function testBasicCreation() : void
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function testClientKnowsItsURLScheme() : void
    {
        $this->assertEquals('http', $this->client->getScheme());
        $this->client->scheme = 'https';
        $this->assertTrue($this->client->save());
        $this->assertEquals('https', $this->client->getScheme());

    }

    public function testKnowsItsHostname() : void 
    {
        $this->assertEquals('examplehostname', $this->client->getHostname());
        $this->client->hostname = 'exampleothername';
        $this->assertTrue($this->client->save());
        $this->assertEquals('exampleothername', $this->client->getHostname());

    }

    public function testClientOwnerIsUser() : void 
    {
        $this->assertInstanceOf(User::class, $this->client->owner);
    }
}
