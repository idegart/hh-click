<?php

namespace App\Services\Activity\Client;

use App\Services\Activity\Services\RouteService;
use GuzzleHttp\ClientInterface;

class Client
{
    private string $token;

    private ClientInterface $client;

    public function __construct(string $token, ClientInterface $client)
    {
        $this->token = $token;
        $this->client = $client;
    }

    private function buildRequest(): Request
    {
        return new Request($this->token, $this->client);
    }

    public function route(): RouteService
    {
        return new RouteService(
            $this->buildRequest()
        );
    }
}