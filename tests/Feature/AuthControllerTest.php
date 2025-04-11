<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user_successfully()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'c_password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'User registered successfully.',
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_register_user_validation_error()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'password123',
            'c_password' => 'different_password',
        ]);

        $response->assertStatus(500)
                 ->assertJsonStructure(['error']);
    }

    public function test_login_user_successfully()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['access_token', 'token_type', 'expires_in'],
                 ]);
    }

    public function test_login_user_invalid_credentials()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(500)
                 ->assertJson([
                     'message' => 'Login failed.',
                 ]);
    }

    public function test_logout_user_successfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/auth/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Successfully logged out.',
                 ]);
    }

    public function test_refresh_token_successfully()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/auth/refresh');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['access_token', 'token_type', 'expires_in'],
                 ]);
    }
}