<?php

namespace App\Http\Requests;

use App\Models\PaymentMonthly;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPaymentMonthlyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:payment_monthlies,id',
        ];
    }
}
