<?php

namespace App\Console\Commands;

use App\Services\ActivityService;
use Illuminate\Console\Command;

class SyncActivities extends Command
{
    protected $signature = 'activities:sync';

    protected $description = 'Sync activities from cache to DB';

    public function handle(ActivityService $activityService): int
    {
        foreach ($activityService->getCachedCounters() as $url => $counter) {
            $activityService->storeActivity($url, $counter);
            $activityService->clearCacheCounter($url);
        }

        return self::SUCCESS;
    }
}
