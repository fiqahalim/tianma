<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMyDocumentRequest;
use App\Http\Requests\UpdateMyDocumentRequest;
use App\Http\Resources\Admin\MyDocumentResource;
use App\Models\MyDocument;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyDocumentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MyDocumentResource(MyDocument::with(['agents'])->get());
    }

    public function store(StoreMyDocumentRequest $request)
    {
        $myDocument = MyDocument::create($request->all());

        foreach ($request->input('document_file', []) as $file) {
            $myDocument->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
        }

        return (new MyDocumentResource($myDocument))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MyDocument $myDocument)
    {
        abort_if(Gate::denies('my_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MyDocumentResource($myDocument->load(['agents']));
    }

    public function update(UpdateMyDocumentRequest $request, MyDocument $myDocument)
    {
        $myDocument->update($request->all());

        if (count($myDocument->document_file) > 0) {
            foreach ($myDocument->document_file as $media) {
                if (!in_array($media->file_name, $request->input('document_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $myDocument->document_file->pluck('file_name')->toArray();
        foreach ($request->input('document_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $myDocument->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
            }
        }

        return (new MyDocumentResource($myDocument))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MyDocument $myDocument)
    {
        abort_if(Gate::denies('my_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myDocument->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
