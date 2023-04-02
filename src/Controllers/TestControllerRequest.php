<?php

namespace Elwafa\LaravelRequestTracker\Controllers;

class TestControllerRequest
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'title' => 'success',
            'detail' => 'success'
        ], 200);
    }
}
