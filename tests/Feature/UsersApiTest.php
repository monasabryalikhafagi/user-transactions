<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
class UsersApiTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_user_must_login_to_can_view_users(): void
    {

        $response = $this->getJson('/api/users');
 
        $response ->assertStatus(401);
 
    }
    public function test_success_logined_user_to_view_users(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $response = $this->actingAs($admin ,'api')->getJson('/api/users');
 
        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['status', 'data' ,'count'])
        );
    }
}

