<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->postJson('/api/meals/1/ingredients', []);

    $response->assertUnauthorized();
});

test('it throws an error if a meal item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1/ingredients', []);
    $response->assertNotFound();
});

test('it throws an error if a name is not supplied', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1/ingredients', []);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name' => 'The name field is required.'
    ]);
});

test('it creates a new ingredient', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->postJson('/api/meals/1/ingredients', [
        'name' => 'Test',
    ]);

    $response->assertCreated();
    $response->assertJsonStructure(['name']);
});
