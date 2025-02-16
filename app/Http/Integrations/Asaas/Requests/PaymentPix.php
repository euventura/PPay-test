<?php

namespace App\Http\Integrations\Asaas\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class PaymentPix extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(
        protected string $payentId
        )
    {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "v3/payments/{$this->payentId}/pixQrCode";
    }
}
