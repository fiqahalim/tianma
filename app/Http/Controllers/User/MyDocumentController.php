<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyDocumentRequest;
use App\Http\Requests\StoreMyDocumentRequest;
use App\Http\Requests\UpdateMyDocumentRequest;
use App\Models\MyDocument;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyDocumentController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $myDocuments = MyDocument::with(['agents', 'media'])->get();

        return view('pages.document.index', compact('myDocuments'));
    }

    public function create()
    {
        $agents = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('pages.document.create', compact('agents'));
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

        return redirect()->route('user.my-documents.index');
    }

    public function show(MyDocument $myDocument)
    {
        $myDocument->load('agents');

        return view('pages.document.show', compact('myDocument'));
    }
}
