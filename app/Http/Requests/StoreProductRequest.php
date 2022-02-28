<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'product_name' => [
                'string',
                'required',
            ],
            'product_id_number' => [
                'string',
                'nullable',
            ],
            'product_code' => [
                'string',
                'required',
                'unique:products',
            ],
            'price' => [
                'required',
            ],
            'selling_price' => [
                'required',
            ],
            'maintenance_price' => [
                'required',
            ],
            'list_price' => [
                'required',
            ],
            'point_value' => [
                'numeric',
                'required',
            ],
            'quantity_per_unit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_cost' => [
                'required',
            ],
            // 'slug' => [
            //     'string',
            //     'required',
            //     'unique:products',
            // ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
        ];
    }
}
