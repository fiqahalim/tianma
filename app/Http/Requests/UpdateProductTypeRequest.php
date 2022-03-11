<?php

namespace App\Http\Requests;

use App\Models\ProductType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'property_name' => [
                'string',
                'required',
            ],
            'building_types.*' => [
                'integer',
            ],
            'building_types' => [
                'array',
            ],
        ];
    }
}
