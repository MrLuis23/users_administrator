<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class UserTest extends TestCase
{
    use  RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_users_list(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users');
        $response->assertOk();
        $response->assertJSon([$user->toArray()]);
    }


    public function test_user_can_add_an_user(){
        
        $user = User::factory()->create();
        $this->actingAs($user);

        // Success
        $response = $this->postJson('api/user/new', [
                "first_name"    => "Luis",
                "last_name"     => "Moreno",
                "email"         => "mr_luis232@hotmail.com",
                'password' =>  bcrypt('pass23'),
                "phone_number"  => "1234567890",
        ]);

        $response->assertCreated();
        //  Endpoint Works
        $response->assertJsonFragment([
            "id" => 2,
        ]);


        // Errors
        // Null values
        $response = $this->postJson('api/user/new', [
            "first_name"    => '',
            "last_name"     => '',
            "email"         => '',
            'password'      => '',
            "phone_number"  => '',
        ]);
        $response->assertInvalid([
            'first_name',
            'last_name', 
            'email',
            'password',
            'phone_number',
        ]);
        //  Invalid Email 
        $response = $this->postJson('api/user/new', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv34344hotmail',
            'password'      => '2324',
            "phone_number"  => '12344567890',
        ]);
        $response->assertInvalid([
            'email',
        ]);

        //  Invalid Phone 
        $response = $this->postJson('api/user/new', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv343@hotmail.com',
            'password'      => '2324',
            "phone_number"  => 'asdfg',
        ]);
        $response->assertInternalServerError();
        //  Invalid Phone 
        $response = $this->postJson('api/user/new', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv343@hotmail.com',
            'password'      => '2324',
            "phone_number"  => '112345678901234',
        ]);
        $response->assertInternalServerError();
    }
    public function test_user_can_update_an_user(){
        
        $user = User::factory()->create();
        $this->actingAs($user);

        // Success
        $response = $this->putJson('api/user/1', [
                "first_name"    => "Luis",
                "last_name"     => "Moreno",
                "email"         => "mr_luis232@hotmail.com",
                'password' =>  bcrypt('pass23'),
                "phone_number"  => "1234567890",
        ]);

        $response->assertSuccessful();
        //  Endpoint Works
        $response->assertJsonFragment([
            "id"            => 1,
            "first_name"    => "Luis",
            "last_name"     => "Moreno",
            "email"         => "mr_luis232@hotmail.com",
            "phone_number"  => "1234567890",
        ]);


        // New user exist in DB
        $this->assertDatabaseHas('users', [
            "id"            => 1,
            "first_name"    => "Luis",
            "last_name"     => "Moreno",
            "email"         => "mr_luis232@hotmail.com",
            "phone_number"  => "1234567890",
        ]);

        // Errors
        // Null values
        $response = $this->putJson('api/user/1', [
            "first_name"    => '',
            "last_name"     => '',
            "email"         => '',
            'password'      => '',
            "phone_number"  => '',
        ]);
        $response->assertInternalServerError();
        //  Invalid Email 
        $response = $this->putJson('api/user/1', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv34344hotmail',
            'password'      => '2324',
            "phone_number"  => '12344567890',
        ]);
        $response->assertInternalServerError();

        //  Invalid Phone 
        $response = $this->putJson('api/user/1', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv343@hotmail.com',
            'password'      => '2324',
            "phone_number"  => 'asdfg',
        ]);
        $response->assertInternalServerError();
        //  Invalid Phone 
        $response = $this->putJson('api/user/1', [
            "first_name"    => 'Luis',
            "last_name"     => 'Moreno',
            "email"         => 'sv343@hotmail.com',
            'password'      => '2324',
            "phone_number"  => '112345678901234',
        ]);
        $response->assertInternalServerError();
    }
    public function test_user_can_delete_an_user(){
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->deleteJson('api/user/1');



    }
}
