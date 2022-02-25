<?php

namespace App\Http\Requests;

use App\Models\MyDocument;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMyDocumentRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return Gate::allows('my_document_create');
    // }

    public function rules()
    {
        return [
            'document_file' => [
                'array',
                'required',
            ],
            'document_file.*' => [
                'required',
            ],
            'document_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
