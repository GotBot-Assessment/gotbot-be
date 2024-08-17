<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->deleteJson('/api/meals/1');

    $response->assertUnauthorized();
});

test('throws 404 if meal item is not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->delete('/api/meals/1');

    $response->assertNotFound();
});

test('it deletes a meal item', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->delete('/api/meals/1');

    $response->assertOk();
    $response->assertJson(['message' => 'Meal deleted successfully.']);
    $this->assertDatabaseCount('meals', 0);
});
