<?php

namespace App\Http\Controllers;

use App\Exceptions\AsaasApiException;
use App\Http\Integrations\Asaas\AsaasConnector;
use App\Http\Integrations\Asaas\Requests\NewPayment;
use App\Http\Integrations\Asaas\Requests\PaymentPix;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(protected Payment $payment, protected AsaasConnector $asaas)
    {}
    
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

        if (isset($paymentResponse['errors']) && !empty($paymentResponse['errors'])) {
            throw new AsaasApiException($paymentResponse);
        }

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
