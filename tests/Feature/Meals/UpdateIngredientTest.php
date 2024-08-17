<?php

use App\Models\Meal;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->putJson('/api/meals/1/ingredients/1', []);

    $response->assertUnauthorized();
});

test('it throws an error if a meal item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/meals/1/ingredients/1', []);
    $response->assertNotFound();
});

test('it throws an error if a name is not supplied', function () {
    $meal = Meal::factory()->create();
    $meal->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/meals/1/ingredients/1', []);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name' => 'The name field is required.'
    ]);
});


test('it throws an error if ingredient doesnt belong to meal item', function () {
    Meal::factory(2)->create();
    Meal::find(2)->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/meals/1/ingredients/1', [
        'name' => 'Tested'
    ]);
    $response->assertForbidden();
});

test('it updates an ingredient', function () {
    $meal = Meal::factory()->create();
    $meal->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->putJson('/api/meals/1/ingredients/1', [
        'name' => 'Test',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['name']);

    $this->assertDatabaseHas('ingredients', [
        'name' => 'Test',
    ]);
});
