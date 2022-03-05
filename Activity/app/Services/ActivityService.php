<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Redis;

class ActivityService
{
    public function getUrlsCounters(): CursorPaginator
    {
        return Activity::query()
            ->select('url', 'total_views')
            ->cursorPaginate();
    }

    public function incrementUrlCounter(string $url): void
    {
        Redis::hincrby('urls', $url, 1);
    }

    public function getCachedCounters(): array
    {
        return Redis::hgetall('urls');
    }

    public function clearCacheCounter(string $url): void
    {
        Redis::hdel('urls', $url);
    }

    public function storeActivity(string $url, int $count): void
    {
        $activity = Activity::query()->firstWhere('url', $url);

        if ($activity) {
            $activity->total_views += $count;
            $activity->save();

            return;
        }

        Activity::query()
            ->create([
                'url' => $url,
                'total_views' => $count,
            ]);
    }
}