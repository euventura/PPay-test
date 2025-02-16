<?php

namespace App\Http\Integrations\Asaas\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class NewPayment extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/v3/payments';
    }

    public function __construct(
        protected string $customer,
        protected string $billingType,
        protected float $value,
        protected string $dueDate,
        protected ?array $creditCard,
        protected ?string $description,
        protected ?int $daysAfterDueDateToRegistrationCancellation,
        protected ?string $externalReference,
        protected ?int $installmentCount,
        protected ?float $totalValue,
        protected ?bool $postalService,
        protected ?array $discount,
        protected ?array $interest,
        protected ?array $fine,
        protected ?array $split
    ) {}

    protected function defaultBody(): array
    {
        return [
            'customer' => $this->customer,
            'billingType' => $this->billingType,
            'value' => $this->value,
            'dueDate' => $this->dueDate,
            'description' => $this->description,
            'daysAfterDueDateToRegistrationCancellation' => $this->daysAfterDueDateToRegistrationCancellation,
            'externalReference' => $this->externalReference,
            'installmentCount' => $this->installmentCount,
            'totalValue' => $this->totalValue,
            'postalService' => $this->postalService,
            'discount' => $this->discount,
            'interest' => $this->interest,
            'fine' => $this->fine,
            'split' => $this->split,
        ];
    }

    /**
     * Set Discount to request
     */
    public function setDiscount(int $value, int $dueDateLimitDays, string $type): self
    {

        $this->discount = [
            'value' => $value,
            'dueDateLimitDays' => $dueDateLimitDays,
            'type' => $type,
        ];

        return $this;
    }

    /**
     * set creditCard to request
     *
     * @param  float  $value
     */
    public function setCreditCard(
        string $holderName,
        string $number,
        string $expiryMonth,
        string $expiryYear,
        string $ccv
    ): self {

        $this->creditCard = [
            'holderName' => $holderName,
            'number' => $number,
            'expiryMonth' => $expiryMonth,
            'expiryYear' => $expiryYear,
            'ccv' => $ccv,
        ];

        return $this;
    }

    /**
     * set interest to request
     */
    public function setInterest(float $value): self
    {
        $this->interest = [
            'value' => $value,
        ];

        return $this;
    }

    /**
     * Set Fine to Request
     */
    public function setFine(float $value, string $type): self
    {
        $this->fine = [
            'value' => $value,
            'type' => $type,
        ];

        return $this;
    }

    /**
     * add new Split to request
     *
     * @param  mixed  $fixedValue
     * @param  mixed  $percentualValue
     * @param  mixed  $totalFixedValue
     * @param  mixed  $externalReference
     * @param  mixed  $description
     * @return void
     */
    public function addSplit(
        string $walletId,
        ?int $fixedValue,
        ?int $percentualValue,
        ?int $totalFixedValue,
        ?string $externalReference,
        ?string $description
    ): self {
        $this->split[] = [
            'walletId' => $walletId,
            'fixedValue' => $fixedValue,
            'percentualValue' => $percentualValue,
            'totalFixedValue' => $totalFixedValue,
            'externalReference' => $externalReference,
            'description' => $description,
        ];

        return $this;
    }
}
