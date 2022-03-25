<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;

use App\Http\Requests\MassDestroyAddOnProductRequest;
use App\Http\Requests\StoreAddOnProductRequest;
use App\Http\Requests\UpdateAddOnProductRequest;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\AddOnProduct;
use Alert;

class AddOnProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $addOns = AddOnProduct::all();

        return view('admin.addons.index', compact('addOns'));
    }

    public function create()
    {
        return view('admin.addons.create');
    }

    public function store(StoreAddOnProductRequest $request)
    {
        $addOnProduct = AddOnProduct::create($request->all());

        if ($request->input('image', false)) {
            $addOnProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $addOnProduct->id]);
        }

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.add-on-products.index');
    }

    public function edit(AddOnProduct $addOnProduct)
    {
        return view('admin.addons.edit', compact('addOnProduct'));
    }

    public function update(UpdateAddOnProductRequest $request, AddOnProduct $addOnProduct)
    {
        $addOnProduct->update($request->all());

        if ($request->input('image', false)) {
            if (!$addOnProduct->image || $request->input('image') !== $addOnProduct->image->file_name) {
                if ($addOnProduct->image) {
                    $addOnProduct->image->delete();
                }
                $addOnProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($addOnProduct->image) {
            $addOnProduct->image->delete();
        }

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.add-on-products.index');
    }

    public function show(AddOnProduct $addOnProduct)
    {
        return view('admin.addons.show', compact('addOnProduct'));
    }

    public function destroy(AddOnProduct $addOnProduct)
    {
        $addOnProduct->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyAddOnProductRequest $request)
    {
        AddOnProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new AddOnProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
