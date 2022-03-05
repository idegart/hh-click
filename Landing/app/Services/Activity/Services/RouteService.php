<?php

namespace App\Services\Activity\Services;

use App\Services\Activity\Client\Request;

class RouteService
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getActivity()
    {
        $response = $this->request->post('/api/jsonrpc', [
            'body' => json_encode([
                'jsonrpc' => '2.0',
                'id' => microtime(),
                'method' => 'getActivities',
                'params' => [],
            ], JSON_THROW_ON_ERROR)
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getActivityByLink(string $link)
    {
        $response = $this->request->post($link, []);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function sendActivity(string $url): void
    {
        $this->request->post('/api/jsonrpc', [
            'body' => json_encode([
                'jsonrpc' => '2.0',
                'id' => microtime(),
                'method' => 'storeActivity',
                'params' => compact('url'),
            ], JSON_THROW_ON_ERROR)
        ]);
    }
}