<?php

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('it blocks an unauthenticated call', function () {
    $response = $this->postJson('/api/meals/1', []);

    $response->assertUnauthorized();
});

test('it throws an error if a meal item isnt found', function () {
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1', []);
    $response->assertNotFound();
});

test('it throws an error if image is not supplied', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1', []);
    $response->assertUnprocessable();
});

test('it throws an error if upload is not an image.', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1', [
        'image' => UploadedFile::fake()->createWithContent('test.txt', '')
    ]);
    $response->assertUnprocessable();
    $response->assertJsonValidationErrors([
        'image' => 'The image field must be a file of type: jpeg, png, jpg, gif, svg.'
    ]);
});

test('it uploads an image to a meal item.', function () {
    Meal::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user, 'api');

    $response = $this->postJson('/api/meals/1', [
        'image' => UploadedFile::fake()->image('test.jpg')
    ]);
    $response->assertOk();
});
