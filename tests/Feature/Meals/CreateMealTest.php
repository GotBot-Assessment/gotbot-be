<?php

use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->postJson('/api/meals', []);

    $response->assertUnauthorized();
});

test('it throws validation error if data is missing', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals', []);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name'        => 'The name field is required.',
        'description' => 'The description field is required.',
        'price'       => 'The price field is required.',
        'category'    => 'The category field is required.',
        'area'        => 'The area field is required.',
    ]);
});

test('it creates a meal item', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals', [
        'category'    => 'Vegetarian',
        'area'        => 'Italian',
        'name'        => 'testmeal',
        'description' => 'testDescription',
        'price'       => 20.99,
    ]);

    $response->assertCreated();
    $this->assertDatabaseCount('meals', 1);
    $this->assertDatabaseHas('meals', [
        'price' => 20.99,
    ]);
});
