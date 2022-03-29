<?php

namespace App\Http\Requests;

use App\Models\BookingSection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSectionRequest extends FormRequest
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
            'section' => [
                'string',
                'required',
            ],
            'seat_layout' => [
                'string',
                'nullable',
            ],
            'deck' => [
                'numeric',
            ],
            'rooms.*' => [
                'integer',
            ],
            'rooms' => [
                'array',
            ],
            'levels.*' => [
                'integer',
            ],
            'levels' => [
                'array',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
        ];
    }
}
