<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Gate;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['customer', 'team', 'createdBy', 'commissions'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orders.create');
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'team', 'createdBy', 'commissions');

        return view('admin.orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'team', 'createdBy', 'commissions');

        $today = Carbon::today();
        $date = $today->addMonth(1);

        return view('admin.orders.show', compact('order', 'date'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        alert()->success(__('global.update_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function transactionDetails(Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments', 'transactions');

        $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->get(['transactions.*']);

        return view('admin.paymentMonthlies.index', compact('order', 'transactions'));
    }
}
