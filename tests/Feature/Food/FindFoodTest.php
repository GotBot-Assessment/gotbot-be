<?php

use App\Models\Food;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/foods/1');

    $response->assertUnauthorized();
});

test('throws 404 if food item is not found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/foods/1');

    $response->assertNotFound();
});

test('it returns a single food item', function () {
    Food::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/foods/1');

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
    ]);
});
