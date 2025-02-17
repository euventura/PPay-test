<?php

namespace Tests\Feature;

use App\Http\Controllers\PaymentController;
use App\Http\Integrations\Asaas\AsaasConnector;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\View\View;

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

    public function test_exception(): void
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $paymentResponse = include 'paymentResponseException.php';
        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200)
        ]);

        $asaasConnector = new AsaasConnector();
        $asaasConnector->withMockClient($mockClient);
        $controller = new PaymentController(new Payment(), $asaasConnector);

        
        $paymentRequest = new PaymentRequest();
        $paymentRequest->merge([
            'customer' => '6519801',
            'billing_type' => 'BOLETO',
            'value' => 2222.0,
            'due_date' => '2024-02-21',
            'description' => 'teste']);
        $response = $controller->makePayment($paymentRequest);
dd($response);
        // $this->assertEquals(resource_path('views/sucesso.blade.php'), $response->getPath());
        // $this->assertInstanceOf(View::class, $response);
    }

    public function test_success(): void
    {
        $paymentResponse = include 'paymentResponse.php';
        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200)
        ]);

        $asaasConnector = new AsaasConnector();
        $asaasConnector->withMockClient($mockClient);
        $controller = new PaymentController(new Payment(), $asaasConnector);

        
        $paymentRequest = new PaymentRequest();
        $paymentRequest->merge([
            'customer' => '6519801',
            'billing_type' => 'BOLETO',
            'value' => 2222.0,
            'due_date' => '2025-02-21',
            'description' => 'teste']);
        $response = $controller->makePayment($paymentRequest);

        $this->assertEquals(resource_path('views/sucesso.blade.php'), $response->getPath());
        $this->assertInstanceOf(View::class, $response);

    }

    public function test_pix(): void
    {
        $paymentResponse = include 'paymentResponsePix.php';
        $mockClient = new MockClient([
            '*/v3/payments' => MockResponse::make(body: $paymentResponse, status: 200),
            '*/v3/payments/*/pixQrCode' => MockResponse::make(body: '', status: 200),
        ]);

        $asaasConnector = new AsaasConnector();
        $asaasConnector->withMockClient($mockClient);
        $controller = new PaymentController(new Payment(), $asaasConnector);

        
        $paymentRequest = new PaymentRequest();
        $paymentRequest->merge([
            'customer' => '6519801',
            'billing_type' => 'PIX',
            'value' => 2222.0,
            'due_date' => '2025-02-21',
            'description' => 'teste']);
        $response = $controller->makePayment($paymentRequest);

        $this->assertEquals(resource_path('views/pix.blade.php'), $response->getPath());
        $this->assertInstanceOf(View::class, $response);
    }

}
