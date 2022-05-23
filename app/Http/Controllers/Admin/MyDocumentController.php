<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyDocumentRequest;
use App\Http\Requests\StoreMyDocumentRequest;
use App\Http\Requests\UpdateMyDocumentRequest;
use App\Models\MyDocument;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyDocumentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myDocuments = MyDocument::with(['agents', 'media'])->get();

        return view('admin.myDocuments.index', compact('myDocuments'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agents = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myDocuments.create', compact('agents'));
    }

    public function store(StoreMyDocumentRequest $request)
    {
        $myDocument = MyDocument::create($request->all());

        foreach ($request->input('document_file', []) as $file) {
            $myDocument->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $myDocument->id]);
        }

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.my-documents.index');
    }

    public function edit(MyDocument $myDocument)
    {
        abort_if(Gate::denies('my_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agents = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myDocument->load('agents');

        return view('admin.myDocuments.edit', compact('agents', 'myDocument'));
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

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.my-documents.index');
    }

    public function show(MyDocument $myDocument)
    {
        abort_if(Gate::denies('my_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myDocument->load('agents');

        return view('admin.myDocuments.show', compact('myDocument'));
    }

    public function destroy(MyDocument $myDocument)
    {
        abort_if(Gate::denies('my_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myDocument->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyMyDocumentRequest $request)
    {
        MyDocument::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('my_document_create') && Gate::denies('my_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MyDocument();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
