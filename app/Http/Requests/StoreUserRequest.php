<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'id_number' => [
                'string',
                'required',
                'unique:users',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'username' => [
                'string',
                'required',
            ],
            'password' => [
                'required',
            ],
            'contact_no' => [
                'string',
                'required',
            ],
            'agent_code' => [
                'string',
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'passport_issue_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'passport_expiry_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'address_1' => [
                'string',
                'nullable',
            ],
            'address_2' => [
                'string',
                'nullable',
            ],
            'postcode' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'state' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'country' => [
                'string',
                'nullable',
            ],
            'nationality' => [
                'string',
                'nullable',
            ],
        ];
    }
}
