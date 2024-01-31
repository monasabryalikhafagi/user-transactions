<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class AuthenticationTest extends TestCase
{
    /**tion
     * A basic feature test example.
     */
    public function test_login_validation(): void
    {
        $response = $this->postJson('/api/login')->assertStatus(422);
            // ->assertJson([
            //     'created' => true,
            // ]);
    }
    public function test_login_correct_user(): void
    {   
        $response = $this->postJson('/api/login', [])->assertStatus(422);



        // $response->assertStatus(200);
    }
}
