<?php

namespace Elwafa\LaravelRequestTracker;

use Elwafa\LaravelRequestTracker\Commands\LaravelRequestTrackerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRequestTrackerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-request-tracker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-request-tracker_table')
            ->hasCommand(LaravelRequestTrackerCommand::class);
    }
}
