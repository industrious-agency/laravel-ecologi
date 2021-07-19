<?php

namespace IndustriousAgency\EcologiLaravel;

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

    public function __construct()
    {
        $httpClient = new Builder();

        $httpClient->addPlugin(new HeaderDefaultsPlugin([
            'Content-Type' => 'application/json',
        ]));

        $this->client = new EcologiClient($httpClient);
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
            env('ECOLOGI_API_KEY'),
            EcologiClient::AUTH_ACCESS_TOKEN
        );
    }
}
