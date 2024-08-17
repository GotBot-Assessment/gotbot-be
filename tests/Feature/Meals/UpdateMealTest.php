<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->putJson('/api/foods/1', []);

    $response->assertUnauthorized();
});

test('throws 404 if food item is not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/foods/1', []);

    $response->assertNotFound();
});

test('it throws validation error if data is missing', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    Meal::factory()->create();

    $response = $this->putJson('/api/foods/1', []);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name'        => 'The name field is required.',
        'description' => 'The description field is required.',
        'price'       => 'The price field is required.',
        'category'    => 'The category field is required.',
        'area'        => 'The area field is required.',
    ]);
});

test('it updates a food item', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/foods/1', [
        'category'    => 'Vegetarian',
        'area'        => 'Italian',
        'name'        => 'testFood',
        'description' => 'testDescription',
        'price'       => 20.99,
    ]);

    $response->assertOk();
    $this->assertDatabaseCount('foods', 1);
    $this->assertDatabaseHas('foods', [
        'price'       => 20.99,
        'category'    => 'Vegetarian',
        'area'        => 'Italian',
        'name'        => 'testFood',
        'description' => 'testDescription',
    ]);
});
