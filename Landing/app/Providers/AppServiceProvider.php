<?php

namespace App\Providers;

use App\Services\Activity\ActivityService;
use App\Services\Activity\Client\Client as ActivityClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ActivityService::class, function () {
            return new ActivityService(
                new ActivityClient(
                    config('services.activity.token'),
                    new Client([
                        'base_uri' => config('services.activity.domain'),
                        'timeout'  => config('services.activity.timeout'),
                    ]),
                ),
            );
        });
    }
}
