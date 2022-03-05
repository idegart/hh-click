<?php

namespace App\Jobs\Activity;

use App\Services\Activity\ActivityService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendActiveRoute implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function handle(ActivityService $activityService): void
    {
        $activityService->route()->sendActivity($this->url);
    }
}
