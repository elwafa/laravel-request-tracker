<?php

namespace Elwafa\LaravelRequestTracker\RegisterEvents;

use Elwafa\LaravelRequestTracker\Listeners\RequestHandled;
use Elwafa\LaravelRequestTracker\Listeners\RequestStarted;
use Illuminate\Foundation\Http\Events\RequestHandled as LaravelRequestHandled;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Event;

class LaravelEvents
{
    public function register()
    {
        Event::listen(Routing::class, function ($event) {
            (new RequestStarted())->handle($event);
        });

        Event::listen(LaravelRequestHandled::class, function ($event) {
            (new RequestHandled())->handle($event);
        });
    }
}
