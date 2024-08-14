<?php

test('throws validation error if name is missing', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['name']
    ]);
});

test('throws validation error if email is missing', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['email']
    ]);
});

test('throws validation error if password is missing', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['password']
    ]);
});

test('throws validation error if password is not confirmed.', function () {
    $response = $this->postJson('/api/auth/register', [
        'password' => 'P@55word!@#'
    ]);

    $response->assertUnprocessable();
    $response->assertJsonStructure([
        'errors' => ['password']
    ]);
    $response->assertJsonValidationErrors(['password' => 'The password field confirmation does not match.']);
});

test('Can create an account', function () {
    $response = $this->postJson('/api/auth/register', [
        'password'              => 'P@55word!@#',
        'password_confirmation' => 'P@55word!@#',
        'name'                  => 'Test',
        'email'                 => 'test@example.com',
    ]);

    $response->assertCreated();
    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com'
    ]);
});


test('Can create an account and return a token', function () {
    $response = $this->postJson('/api/auth/register', [
        'password'              => 'P@55word!@#',
        'password_confirmation' => 'P@55word!@#',
        'name'                  => 'Test',
        'email'                 => 'test@example.com',
    ]);

    $response->assertSimilarJson([
       'status' => true
    ]);
});
