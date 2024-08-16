<?php

test('it blocks an unauthenticated call', function () {
    $response = $this->getJson('/api/auth/logout', []);

    $response->assertUnauthorized();
});
