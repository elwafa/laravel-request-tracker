<?php

namespace Elwafa\LaravelRequestTracker\Commands;

use Illuminate\Console\Command;

class LaravelRequestTrackerCommand extends Command
{
    public $signature = 'laravel-request-tracker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
