<?php

namespace Elwafa\LaravelRequestTracker\RegisterEvents;

use Elwafa\LaravelRequestTracker\Listeners\Octane\RequestHandled;
use Illuminate\Support\Facades\Event;
use Laravel\Octane\Events\RequestReceived;
use Laravel\Octane\Events\RequestTerminated;

class OctaneEvents
{
    public function register()
    {
        // Register RequestStarted event and Request terminated Octane event
        Event::listen(RequestReceived::class, function ($event) {
            (new RequestReceived())->handle($event);
        });

        Event::listen(RequestTerminated::class, function ($event) {
            (new RequestHandled())->handle($event);
        });
    }
}
