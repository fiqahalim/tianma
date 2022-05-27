<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\MassDestroyDeceasedRequest;
use App\Http\Requests\StoreDeceasedRequest;
use App\Http\Requests\UpdateDeceasedRequest;

use App\Models\Decease;
use Alert;

class DeceaseController extends Controller
{
    public function index()
    {
        return view('admin.customers.deceased.index');
    }

    public function create()
    {
        return view('admin.customers.deceased.create');
    }

    public function edit(Decease $decease)
    {
        return view('admin.customers.deceased.edit', compact('decease'));
    }

    public function show(Decease $decease)
    {
        return view('admin.customers.deceased.show');
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
