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
        $response = $this->postJson('/api/login');
        
        $response->assertStatus(422);
    }
    public function test_login_correct_user(): void
    {   
        $response = $this->postJson('/api/login', ["email" => "admin@gmail.com" , "password" => "1234566789"])->assertStatus(401);
    }
}
