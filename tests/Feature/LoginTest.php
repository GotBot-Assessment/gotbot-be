<?php

test('throws validation error if email is missing', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['email']
    ]);
});

test('throws validation error if password is missing', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['password']
    ]);
});
