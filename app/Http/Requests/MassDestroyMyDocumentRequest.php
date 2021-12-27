<?php

namespace App\Http\Requests;

use App\Models\MyDocument;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMyDocumentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('my_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:my_documents,id',
        ];
    }
}
