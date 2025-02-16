<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LVR\CreditCard\CardNumber;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer' => 'required|string',
            'billing_type' => Rule::in(['BOLETO', 'PIX', 'CREDIT_CARD']),
            'value' => 'required|numeric',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
            'days_after_due_date_to_registration_cancellation' => 'nullable|integer',
            'external_reference' => 'nullable|string',
            'installment_count' => 'nullable|integer',
            'total_value' => 'nullable|numeric',
            'postal_service' => 'nullable|boolean',
            'discount' => 'nullable|array:value,due_date_limit_days,type',
            'interest' => 'nullable|array:value',
            'fine' => 'nullable|array:value,type',
            'split' => 'nullable|array:wallet_id',
            'credit_card' => 'required_if:billing_type,CREDIT_CARD|array:holderName,number,expiryMonth,expiryYear,ccv',
            'credit_card.number' => ['nullable', 'required_if:billing_type,CREDIT_CARD', new CardNumber],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer.required' => 'O campo cliente é obrigatório.',
            'billing_type.in' => 'O tipo de pagamento selecionado é inválido.',
            'value.required' => 'O campo valor é obrigatório.',
            'value.numeric' => 'O campo valor deve ser numérico.',
            'due_date.required' => 'O campo data de vencimento é obrigatório.',
            'due_date.date' => 'O campo data de vencimento deve ser uma data válida.',
            'credit_card.required_if' => 'Os dados do cartão de crédito são obrigatórios quando o tipo de pagamento é cartão de crédito.',
            'credit_card.number.required_if' => 'O número do cartão de crédito é obrigatório.',
        ];
    }
}
