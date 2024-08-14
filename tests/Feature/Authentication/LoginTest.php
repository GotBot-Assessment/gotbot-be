<?php

use App\Models\User;

test('throws validation error if email is missing', function () {
    $response = $this->postJson('/api/auth/login', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['email']
    ]);
});

test('throws validation error if password is missing', function () {
    $response = $this->postJson('/api/auth/login', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['password']
    ]);
});

test('Can create an account and return a token', function () {
    $user = User::factory(1, [
        'password' => 'P@55word!@#',
        'email'    => 'test@example.com',
    ])->create();

    $response = $this->postJson('/api/auth/login', [
        'password' => 'P@55word!@#',
        'email'    => 'test@example.com',
    ]);

    $response->assertOk();
    $response->assertJsonStructure([
        'status',
        'token'
    ]);
});
