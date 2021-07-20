<?php

namespace Industrious\LaravelEcologi;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use OwenVoke\Ecologi\Api\Purchasing;
use OwenVoke\Ecologi\Api\Reporting;
use OwenVoke\Ecologi\Client as EcologiClient;
use OwenVoke\Ecologi\HttpClient\Builder;

class LaravelEcologi
{
    /**
     * @var EcologiClient
     */
    private EcologiClient $client;

    /**
     * @var string
     */
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = new EcologiClient(
            $this->httpClient()
        );
    }

    /**
     * @return Purchasing
     */
    public function purchase(): Purchasing
    {
        $this->authenticate();

        return $this->client->purchase();
    }

    /**
     * @return Reporting
     */
    public function report(): Reporting
    {
        return $this->client->report();
    }

    private function authenticate(): void
    {
        $this->client->authenticate(
            $this->apiKey,
            EcologiClient::AUTH_ACCESS_TOKEN
        );
    }

    /**
     * @return Builder
     */
    private function httpClient(): Builder
    {
        $httpClient = new Builder();

        $httpClient->addPlugin(new HeaderDefaultsPlugin([
            'Content-Type' => 'application/json',
        ]));

        return $httpClient;
    }
}
