<?php

namespace App\Http\Integrations\Asaas;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class AsaasConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return env('ASAAS_URL', '	https://api-sandbox.asaas.com/');
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'access_token' => env('ASAAS_TOKEN', '$aact_MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6Ojk4NWMwYzA5LTQ4OGQtNGM0OC05Mzc2LWU2NDFhMGY0Zjc2MDo6JGFhY2hfODFlODcwMTUtNTA0ZS00NDg3LWFkY2ItOTRjNjk1MjU2Yzdh'),
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
