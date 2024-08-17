<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/meals/1');

    $response->assertUnauthorized();
});

test('throws 404 if meal item is not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/meals/1');

    $response->assertNotFound();
});

test('it returns a single meal item', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/meals/1');

    $response->assertOk();
    $response->assertJsonStructure([
        'id',
        'name',
        'description',
        'category',
        'area',
        'price',
        'createdAt',
        'updatedAt',
        'ingredients',
        'image'
    ]);
});
