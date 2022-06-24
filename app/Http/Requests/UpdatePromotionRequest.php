<?php

namespace App\Http\Requests;

use App\Models\Promotion;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePromotionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'promo_code' => [
                'string',
                'required',
            ],
            'promo_type' => [
                'string',
                'nullable',
            ],
            'promo_value' => [
                'numeric',
            ],
            'cart_value' => [
                'numeric',
            ],
        ];
    }
}
