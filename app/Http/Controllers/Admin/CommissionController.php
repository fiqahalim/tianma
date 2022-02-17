<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommissionRequest;
use App\Http\Requests\StoreCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use App\Models\Commission;
use App\Models\Order;
use App\Models\User;
use Gate;
use Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commissions = Commission::with(['user', 'orders', 'team'])->get();

        return view('admin.commissions.index', compact('commissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('commission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('agent_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('ref_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.commissions.create', compact('orders', 'users'));
    }

    public function store(StoreCommissionRequest $request)
    {
        $commission = Commission::create($request->all());

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.commissions.index');
    }

    public function edit(Commission $commission)
    {
        abort_if(Gate::denies('commission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('agent_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('ref_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $commission->load('user', 'orders', 'team');

        return view('admin.commissions.edit', compact('commission', 'orders', 'users'));
    }

    public function update(UpdateCommissionRequest $request, Commission $commission)
    {
        $commission->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.commissions.index');
    }

    public function show(Commission $commission)
    {
        abort_if(Gate::denies('commission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commission->load('user', 'orders', 'team');

        return view('admin.commissions.show', compact('commission'));
    }

    public function destroy(Commission $commission)
    {
        abort_if(Gate::denies('commission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commission->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyCommissionRequest $request)
    {
        Commission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
