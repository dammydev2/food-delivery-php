<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $registerData = [
            "first_name" => "Damilola",
            "last_name" => "Yakubu",
            "email" => "test@test.com",
            "password" => "123@Yakubu",
            "password_confirmation" => "123@Yakubu",
            "phone" => "+234909898902"
        ];
        $response = $this->post('/api/auth/register', $registerData);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'message', 'data']);
    }
}
