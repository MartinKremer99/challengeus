<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{


    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_login_success(): void
    {
        $response = $this->post('/api/user/login', [
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD')
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'token',
                'user'
            ]
        ]);
    }

    public function test_login_bad_input(): void
    {
        $response = $this->post('/api/user/login', [
            'email' => env('ADMIN_EMAIL'),
        ]);

        $response->assertBadRequest();

        $response->assertJsonStructure([
            'status',
            'message',
            'data'
        ]);
    }

    public function test_login_bad_email(): void
    {
        $response = $this->post('/api/user/login', [
            'email' => 'testemail.com',
            'password' => env('ADMIN_PASSWORD')
        ]);

        $response->assertBadRequest();

        $response->assertJsonStructure([
            'status',
            'message',
            'data'
        ]);
    }


}
