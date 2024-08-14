<?php

use App\Models\Food;
use App\Models\User;

test('it blocks an unauthenticated call', function () {
    $response = $this->putJson('/api/foods/1/ingredients/1', []);

    $response->assertUnauthorized();
});

test('it throws an error if a food item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/foods/1/ingredients/1', []);
    $response->assertNotFound();
});

test('it throws an error if a name is not supplied', function () {
    $food = Food::factory()->create();
    $food->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/foods/1/ingredients/1', []);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'name' => 'The name field is required.'
    ]);
});


test('it throws an error if ingredient doesnt belong to food item', function () {
    Food::factory(2)->create();
    Food::find(2)->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->putJson('/api/foods/1/ingredients/1', [
        'name' => 'Tested'
    ]);
    $response->assertForbidden();
});

test('it updates an ingredient', function () {
    $food = Food::factory()->create();
    $food->ingredients()->create(['name' => 'Test']);
    $user = User::factory()->create();
    $this->actingAs($user, 'api');
    $response = $this->putJson('/api/foods/1/ingredients/1', [
        'name' => 'Test',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['name']);

    $this->assertDatabaseHas('ingredients', [
        'name' => 'Test',
    ]);
});
