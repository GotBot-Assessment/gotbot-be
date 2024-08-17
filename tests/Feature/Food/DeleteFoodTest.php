<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->deleteJson('/api/foods/1');

    $response->assertUnauthorized();
});

test('throws 404 if food item is not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->delete('/api/foods/1');

    $response->assertNotFound();
});

test('it deletes a food item', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->delete('/api/foods/1');

    $response->assertOk();
    $response->assertJson(['message' => 'Food item deleted successfully.']);
    $this->assertDatabaseCount('foods', 0);
});
