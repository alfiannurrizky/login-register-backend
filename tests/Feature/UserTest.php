<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_register()
    {
        $password = $this->faker->password(8);

        $user = [
            'name' => 'john',
            'email' => 'johny@gmail.com',
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->postJson('/api/register', $user);

        $results = [
            "name" => $user["name"],
            "email" => $user["email"],
        ];

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', $results);
    }

    public function test_user_failed_register_required()
    {
        $password = $this->faker->password(8);

        $user = [
            'name' => 'john',
            'email' => '',
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->postJson('/api/register', $user);

        $response->assertInvalid(['email']);
    }

    public function test_password_confirmation_doesnt_match()
    {
        $password = $this->faker->password(8);

        $user = [
            'name' => 'john',
            'email' => 'johny@gmail.com',
            'password' => $password,
            'password_confirmation' => 'asdada'
        ];

        $response = $this->postJson('/api/register', $user);

        $this->assertNotSame($user['password'], $user['password_confirmation']);
    }

    public function test_user_can_login()
    {
        $user = [
            'email' => 'example@gmail.com',
            'password' => '12345'
        ];

        $response = $this->postJson('/api/login', $user);

        $response->assertStatus(200);

    }
}
