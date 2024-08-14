<?php

use App\Models\Food;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->postJson('/api/foods/1/ingredients', []);

    $response->assertUnauthorized();
});

test('it throws an error if a food item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/foods/1/ingredients', []);
    $response->assertNotFound();
});

test('it throws an error if a name is not supplied', function () {
    Food::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/foods/1/ingredients', []);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name' => 'The name field is required.'
    ]);
});

test('it creates a new ingredient', function () {
    Food::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->postJson('/api/foods/1/ingredients', [
        'name' => 'Test',
    ]);

    $response->assertCreated();
    $response->assertJsonStructure(['name']);
});
