<?php

namespace Elwafa\LaravelRequestTracker;

use Elwafa\LaravelRequestTracker\RegisterEvents\LaravelEvents;
use Elwafa\LaravelRequestTracker\RegisterEvents\OctaneEvents;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRequestTrackerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        if ($this->runningWithOctane()) {
            (new OctaneEvents())->register();
        } else {
            (new LaravelEvents())->register();
        }

        $package
            ->name('laravel-request-tracker')
            ->hasConfigFile('laravel-request-tracker')
            ->hasRoutes('api');
    }

    public function runningWithOctane(): bool
    {
        return isset($_SERVER['LARAVEL_OCTANE']);
    }
}
