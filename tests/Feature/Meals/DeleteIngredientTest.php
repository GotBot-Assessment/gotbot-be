<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->deleteJson('/api/foods/1/ingredients/1', []);

    $response->assertUnauthorized();
});

test('it throws an error if a food item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->deleteJson('/api/foods/1/ingredients/1', []);
    $response->assertNotFound();
});

test('it throws an error if ingredient doesnt belong to food item', function () {
    Meal::factory(2)->create();
    Meal::find(2)->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->deleteJson('/api/foods/1/ingredients/1', [
        'name' => 'Tested'
    ]);
    $response->assertForbidden();
});

test('it deletes an ingredient', function () {
    $food = Meal::factory()->create();
    $food->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->deleteJson('/api/foods/1/ingredients/1');

    $response->assertOk();
    $response->assertJsonStructure(['message']);
    $this->assertDatabaseEmpty('ingredients');
});
