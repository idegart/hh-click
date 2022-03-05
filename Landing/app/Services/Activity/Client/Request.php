<?php

namespace App\Services\Activity\Client;

use App\Services\Activity\Exceptions\BadResponseException;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class Request
{
    private string $token;

    private ClientInterface $client;

    public function __construct(string $token, ClientInterface $client)
    {
        $this->token = $token;
        $this->client = $client;
    }

    public function post(string $uri, array $options): ResponseInterface
    {
        return $this->execute('post', $uri, $options);
    }

    private function execute(string $method, string $uri, array $options): ResponseInterface
    {
        try {
            return $this->client->request($method, $uri, $this->mergeHeaders($options));
        } catch (Throwable $exception) {
            throw new BadResponseException("Bad Response");
        }
    }

    private function mergeHeaders(array $options)
    {
        return array_merge([
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ], $options);
    }
}