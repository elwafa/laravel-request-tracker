<?php

it('get test', function () {
    $response = $this->get('/testing-laravel-request-tracker/test?query=1&tracker=2');
    expect($response->getStatusCode())->toBe(200);
});

it('test post', function () {
    $response = $this->post('/testing-laravel-request-tracker/test?query=1&tracker=2', [
        'name' => 'Sally',
        'age' => '25',
    ]);
    expect($response->getStatusCode())->toBe(200);
});
