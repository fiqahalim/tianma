<?php

namespace App\Http\Requests;

use App\Models\ContactPerson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class MassDestroyContactPersonRequest extends FormRequest
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
            'ids.*' => 'exists:contact_people,id',
        ];
    }
}
