<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->deleteJson('/api/meals/1/ingredients/1', []);

    $response->assertUnauthorized();
});

test('it throws an error if a meal item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->deleteJson('/api/meals/1/ingredients/1', []);
    $response->assertNotFound();
});

test('it throws an error if ingredient doesnt belong to meal item', function () {
    Meal::factory(2)->create();
    Meal::find(2)->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->deleteJson('/api/meals/1/ingredients/1', [
        'name' => 'Tested'
    ]);
    $response->assertForbidden();
});

test('it deletes an ingredient', function () {
    $meal = Meal::factory()->create();
    $meal->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->deleteJson('/api/meals/1/ingredients/1');

    $response->assertOk();
    $response->assertJsonStructure(['message']);
    $this->assertDatabaseEmpty('ingredients');
});
