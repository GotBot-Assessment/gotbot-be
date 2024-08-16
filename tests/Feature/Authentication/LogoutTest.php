<?php

use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/auth/logout', []);

    $response->assertUnauthorized();
});

test('it logs the user out', function () {
    $user = User::factory()->create();
    $token = $user->createToken('Chef')->accessToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson('/api/auth/logout', [])
        ->assertSuccessful();
});
