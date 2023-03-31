<?php

namespace Elwafa\LaravelRequestTracker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elwafa\LaravelRequestTracker\LaravelRequestTracker
 */
class LaravelRequestTracker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Elwafa\LaravelRequestTracker\LaravelRequestTracker::class;
    }
}
