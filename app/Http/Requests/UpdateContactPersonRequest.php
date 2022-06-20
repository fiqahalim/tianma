<?php

namespace App\Http\Requests;

use App\Models\ContactPerson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactPersonRequest extends FormRequest
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
            'cperson_name' => [
                'string',
                'nullable',
            ],
            'cperson_no' => [
                'string',
                'nullable',
            ],
            'relationships' => [
                'string',
                'nullable',
            ],
        ];
    }
}
