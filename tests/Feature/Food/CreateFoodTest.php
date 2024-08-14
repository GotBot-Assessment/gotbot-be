<?php

use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->postJson('/api/foods', []);

    $response->assertUnauthorized();
});

test('it throws validation error if data is missing', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/foods', []);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name'        => 'The name field is required.',
        'description' => 'The description field is required.',
        'price'       => 'The price field is required.',
        'type'        => 'The type field is required.'
    ]);
});

test('it throws validation if type is wrong', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/foods', [
        'type' => 'json',
    ]);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'type' => 'The selected type is invalid.'
    ]);
});

test('it creates a food item', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/foods', [
        'type'        => 'main',
        'name'        => 'testFood',
        'description' => 'testDescription',
        'price'       => 20.99,
    ]);

    $response->assertCreated();
    $this->assertDatabaseCount('foods', 1);
    $this->assertDatabaseHas('foods', [
        'price' => 20.99,
    ]);
});
