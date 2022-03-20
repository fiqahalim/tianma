<?php

namespace App\Http\Requests;

use App\Models\Level;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLevelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'level_name' => [
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
