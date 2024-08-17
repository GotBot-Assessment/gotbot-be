<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/foods');

    $response->assertUnauthorized();
});

test('it lists all food items', function () {
    $user = User::factory()->create();
    Meal::factory(2)->create();
    $this->actingAs($user, 'api');

    $response = $this->getJson('/api/foods');
    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'name',
                'description',
                'category',
                'area',
                'price',
                'createdAt',
                'updatedAt',
                'ingredientsCount',
                'ingredients',
                'image',
            ]
        ],
        'meta' => [
            'current_page',
            'total',
            'per_page',
        ]
    ]);
});
