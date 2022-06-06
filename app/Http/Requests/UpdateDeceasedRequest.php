<?php

namespace App\Http\Requests;

use App\Models\Decease;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeceasedRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return true;
    // }

    public function rules()
    {
        return [
            'decease_name' => [
                'string',
                'required',
            ],
            'decease_id_number' => [
                'string',
                'required',
                // 'unique:deceased_infos,decease_id_number,' . request()->route('decease')->id,
            ],
            'decease_chinese_name' => [
                'string',
                'nullable',
            ],
            'decease_gender' => [
                'string',
                'nullable',
            ],
            'decease_religion' => [
                'string',
                'nullable',
            ],
            'decease_maritial' => [
                'string',
                'nullable',
            ],
            'decease_dialect' => [
                'string',
                'nullable',
            ],
            'decease_national' => [
                'string',
                'nullable',
            ],
            'decease_income' => [
                'numeric',
                'nullable',
            ],
            'decease_occupation' => [
                'string',
                'nullable',
            ],
            'miling_flag' => [
                'string',
                'nullable',
            ],
            'open_niche' => [
                'string',
                'nullable',
            ],
            'undertaker' => [
                'string',
                'nullable',
            ],
            'ref_no' => [
                'string',
                'nullable',
            ],
            'bury_cert' => [
                'string',
                'nullable',
            ],
            'cremation_cert' => [
                'string',
                'nullable',
            ],
            'casket' => [
                'string',
                'nullable',
            ],
            'chinese_birth_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'birth_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'death_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'bury_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'grain_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'issue_postcode' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'issue_state' => [
                'string',
                'max:45',
                'nullable',
            ],
            'issue_city' => [
                'string',
                'max:45',
                'nullable',
            ],
            'issue_address_1' => [
                'string',
                'nullable',
            ],
            'issue_address_2' => [
                'string',
                'nullable',
            ],
            'issue_country' => [
                'string',
                'nullable',
            ],
            'funeral_postcode' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'funeral_state' => [
                'string',
                'max:45',
                'nullable',
            ],
            'funeral_city' => [
                'string',
                'max:45',
                'nullable',
            ],
            'funeral_address_1' => [
                'string',
                'nullable',
            ],
            'funeral_address_2' => [
                'string',
                'nullable',
            ],
            'funeral_country' => [
                'string',
                'nullable',
            ],
            'remark' => [
                'string',
                'nullable',
            ],
            'item_elements' => [
                'string',
                'nullable',
            ],
            'document_file' => [
                'array',
            ],
        ];
    }
}
