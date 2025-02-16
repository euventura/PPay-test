<?php

namespace Tests\Feature;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PaymentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_validation_failed(): void
    {
        $response = $this->post('/payment', []);
        $response->assertStatus(302);
    }

    public function test_success(): void
    {
        $paymentResponse = include 'paymentResponse.php';
        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200),
        ]);

        $response = $this->post('/payment', [
            'customer' => '6519801',
            'billing_type' => 'BOLETO',
            'value' => 2222.0,
            'due_date' => '2025-02-21',
            'description' => 'teste']);

        $response->assertStatus(200);

    }

    public function test_invalid_due_date(): void
    {
        $paymentResponse = include 'paymentResponse.php';
        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200),
        ]);

        $response = $this->post('/payment', [
            'customer' => '6519801',
            'billing_type' => 'BOLETO',
            'value' => 2222.0,
            'due_date' => '2024-02-21',
            'description' => 'teste']);

        $response->assertStatus(302);

    }

    public function test_pix(): void
    {
        $paymentResponse = include 'paymentResponse.php';

        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200),
            '*/v3/payments/*/pixQrCode' => MockResponse::make(body: '', status: 200),
        ]);

        $response = $this->post('/payment', [
            'customer' => '6519801',
            'billing_type' => 'BOLETO',
            'value' => 2222.0,
            'due_date' => '2025-02-21',
            'description' => 'teste']);

        $response->assertStatus(200);
    }
}
