<?php

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'testing-laravel-request-tracker'], function () {
    Route::get('test', Elwafa\LaravelRequestTracker\Controllers\TestControllerRequest::class.'@index');
    Route::post('test', Elwafa\LaravelRequestTracker\Controllers\TestControllerRequest::class.'@index');
});

