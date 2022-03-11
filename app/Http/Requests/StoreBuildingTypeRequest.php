<?php

namespace App\Http\Requests;

use App\Models\BuildingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBuildingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'building_name' => [
                'string',
                'required',
            ],
        ];
    }
}
