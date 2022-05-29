<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroyDeceasedRequest;
use App\Http\Requests\StoreDeceasedRequest;
use App\Http\Requests\UpdateDeceasedRequest;

use App\Models\Decease;
use App\Models\ProductBooking;
use Alert;
use Carbon\Carbon;

class DeceaseController extends Controller
{
    public function index()
    {
        $deceases = Decease::with(['lotID'])->get();
        return view('admin.customers.deceased.index', compact('deceases'));
    }

    public function create()
    {
        $lotIDs = ProductBooking::pluck('seats', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customers.deceased.create', compact('lotIDs'));
    }

    public function edit(Decease $decease_person)
    {
        $lotIDs = ProductBooking::pluck('seats', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customers.deceased.edit', compact('decease_person', 'lotIDs'));
    }

    public function show(Decease $decease_person)
    {
        $decease_person->load('lotID');

        return view('admin.customers.deceased.show', compact('decease_person'));
    }

    public function store(StoreDeceasedRequest $request)
    {
        $decease = Decease::create($request->all());

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.decease-people.index');
    }

    public function update(UpdateDeceasedRequest $request, Decease $decease)
    {
        $decease->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.decease-people.index');
    }

    public function destroy(Decease $decease)
    {
        $decease->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyDeceasedRequest $request)
    {
        Decease::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
