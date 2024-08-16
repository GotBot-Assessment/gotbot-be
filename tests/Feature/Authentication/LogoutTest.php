<?php

use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/auth/logout', []);

    $response->assertUnauthorized();
});

test('it logs the user out', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $this->getJson('/api/auth/logout', [])
        ->assertSuccessful();
    $this->assertGuest();
    $this->assertNull(auth()->user());
});
