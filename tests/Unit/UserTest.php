<?php

test('cms-login', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertViewIs('auth.login');
});
