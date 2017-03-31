<?php

namespace OmekaModuleStarterKit\Repository;

use GuzzleHttp\Client;

class MovieRepository
{
    private $endpoint;
    private $client;

    public function __construct(string $endpoint, Client $client)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function searchMovies(string $query)
    {
        $response = $this->client->get($this->endpoint, [
            'query' => ['s' => $query],
        ]);

        return json_decode($response->getBody())->Search;
    }
}