<?php

namespace App\Services\Activity;

use App\Services\Activity\Client\Client;

class ActivityService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function route(): Services\RouteService
    {
        return $this->client->route();
    }
}