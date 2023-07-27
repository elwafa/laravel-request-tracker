<?php

namespace Elwafa\LaravelRequestTracker;

use Elwafa\LaravelRequestTracker\Listeners\RequestHandled;
use Elwafa\LaravelRequestTracker\Listeners\RequestStarted;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRequestTrackerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        Event::listen(Routing::class, function ($event) {
            (new RequestStarted())->handle($event);
        });

        Event::listen(\Illuminate\Foundation\Http\Events\RequestHandled::class, function ($event) {
            (new RequestHandled())->handle($event);
        });

        $package
            ->name('laravel-request-tracker')
            ->hasConfigFile('laravel-request-tracker')
            ->hasRoutes('api');
    }
}
