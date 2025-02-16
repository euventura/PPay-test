<?php

namespace App\Http\Controllers;

use App\Exceptions\AsaasApiException;
use App\Http\Integrations\Asaas\AsaasConnector;
use App\Http\Integrations\Asaas\Requests\NewPayment;
use App\Http\Integrations\Asaas\Requests\PaymentPix;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct(protected Payment $payment, protected AsaasConnector $asaas) {}

    public function makePayment(PaymentRequest $request)
    {
        $paymentRequest = new NewPayment(
            $request->input('customer'),
            $request->input('billing_type'),
            $request->input('value'),
            $request->input('due_date'),
            $request->input('credit_card'),
            $request->input('description'),
            $request->input('days_after_due_date_to_registration_cancellation'),
            $request->input('external_reference'),
            $request->input('installment_count'),
            $request->input('total_value'),
            $request->input('postal_service'),
            $request->input('discount'),
            $request->input('interest'),
            $request->input('fine'),
            $request->input('split')
        );

        $response = $this->asaas->send($paymentRequest);
        $paymentResponse = json_decode($response->body(), true);

        $paymentRegistry = $this->payment->create([
            'customer' => $request->input('customer'),
            'billing_type' => $request->input('billing_type'),
            'value' => $request->input('value'),
            'due_date' => $request->input('due_date'),
            'credit_card' => $request->input(key: 'credit_card'),
            'description' => $request->input('description'),
            'days_after_due_date_to_registration_cancellation' => $request->input('days_after_due_date_to_registration_cancellation'),
            'external_reference' => $request->input('external_reference'),
            'installment_count' => $request->input('installment_count'),
            'total_value' => $request->input('total_value'),
            'postal_service' => $request->input('postal_service'),
            'discount' => $request->input('discount'),
            'interest' => $request->input('interest'),
            'fine' => $request->input('fine'),
            'split' => $request->input('split'),
            'server_response' => $paymentResponse,
        ]);

        if (isset($paymentResponse['errors']) && ! empty($paymentResponse['errors'])) {
            $paymentRegistry->status = 'error';
            throw new AsaasApiException($paymentResponse);
        }
        $paymentRegistry->status = $paymentResponse['status'];

        if ($paymentResponse['billingType'] == 'PIX') {
            return $this->retrivePix($paymentResponse);
        }

        return view('sucesso', compact('paymentResponse'));

    }

    protected function retrivePix($paymentResponse)
    {

        $pixResponse = $this->asaas->send(new PaymentPix($paymentResponse['id']));
        $pixResponseJson = json_decode($pixResponse->body(), true);

        return view('pix', compact('pixResponseJson'));
    }
}
