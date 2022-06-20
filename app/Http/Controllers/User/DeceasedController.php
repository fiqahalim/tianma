<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroyDeceasedRequest;
use App\Http\Requests\StoreDeceasedRequest;
use App\Http\Requests\UpdateDeceasedRequest;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;

use App\Models\Decease;
use App\Models\ProductBooking;
use App\Models\AddOnProduct;
use App\Models\Order;
use Alert;
use Carbon\Carbon;

class DeceasedController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        $deceases = Decease::with(['lotID'])->get();
        return view('pages.customer.deceased.index', compact('deceases'));
    }

    public function create()
    {
        $lotIDs = Order::whereNotNull('product_bookings_id')
            ->with(['lotID', 'createdBy'])
            ->get();

        $addOns = AddOnProduct::pluck('name', 'id')->prepend('Please Select');

        return view('pages.customer.deceased.create', compact('lotIDs', 'addOns'));
    }

    public function edit(Decease $decease_person)
    {
        $decease_person->load('lotID');

        $addOns = AddOnProduct::pluck('name', 'id')->prepend('Please Select');

        return view('pages.customer.deceased.edit', compact('decease_person', 'addOns'));
    }

    public function show(Decease $decease_person)
    {
        $decease_person->load('lotID');

        return view('pages.customer.deceased.show', compact('decease_person'));
    }

    public function store(StoreDeceasedRequest $request)
    {
        $decease = Decease::create($request->all());

        foreach ($request->input('document_file', []) as $file) {
            $decease->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $decease->id]);
        }

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('user.decease-people.index');
    }

    public function update(UpdateDeceasedRequest $request, Decease $decease_person)
    {
        $decease_person->update($request->all());

        if (count($decease_person->document_file) > 0) {
            foreach ($decease_person->document_file as $media) {
                if (!in_array($media->file_name, $request->input('document_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $decease_person->document_file->pluck('file_name')->toArray();
        foreach ($request->input('document_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $decease_person->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('document_file');
            }
        }

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('user.decease-people.index');
    }

    public function destroy(Decease $decease_person)
    {
        $decease_person->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyDeceasedRequest $request)
    {
        Decease::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new Decease();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
