<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**
     * A basic feature test example.
     */
    public function test_an_existing_user_can_login(): void
    {
        // $this->withoutExceptionHandling();
        $credentials = ['email' => 'example@example.com', 'password' => '123'];
        $response = $this->post('/api/login', $credentials);

        $response->assertSuccessful();
        $response->assertJsonStructure(['data'=> ['token']]);
    }

    public function test_a_non_existing_user_cannot_login(): void
    {
        // $this->withoutExceptionHandling();
        $credentials = ['email' => 'example@notrealemail.com', 'password' => 'qwerty'];
        $response = $this->post('/api/login', $credentials);

        $response->assertStatus(401);
        $response->assertJsonFragment(['status'=> 401]);
    }
}
