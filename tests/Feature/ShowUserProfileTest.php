<?php

use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/user', []);

    $response->assertUnauthorized();
});

test('it shows user profile when authenticated', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/user', []);

    $response->assertOk();
    $response->assertJson([
        'email' => 'test@example.com',
    ]);
    $response->assertJsonStructure([
       'id',
       'name',
       'email',
    ]);
});
