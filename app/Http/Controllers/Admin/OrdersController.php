<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Installment;
use Gate;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;

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

        $order->load('customer', 'team', 'createdBy', 'commissions', 'products');

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

        $order->load('customer', 'createdBy', 'products', 'bookLocations', 'installments', 'fullPayments');

        if($order->customer->mode == 'Installment') {
            $amount = $order->installments->downpayment;
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        } else {
            $amount = $order->fullPayments->amount;
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        }

        return view('admin.orders.show', compact('order', 'date', 'amountFormat'));
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

    public function showCalculator(Order $order)
    {
        return view('admin.orders.pay-later-calculator', compact('order'));
    }

    public function calculatePayLater(Request $request, Order $order)
    {
        $requestData = $request->all();

        $installments = new Installment;
        $installments->downpayment = $requestData['downpayment'];
        $installments->amount = $requestData['amount'];
        $installments->outstanding_balance = $request['outstanding_balance'];
        $installments->monthly_installment = $request['monthly_installment'];
        $installments->last_month_payment = $request['last_month_payment'];
        $installments->installment_year = $request['installment_year'];
        $installments->created_at = Carbon::now();
        $installments->customer_id = $order->customer->id;
        $installments->created_by = $order->customer->created_by;
        $installments->order_id = $order->id;
        $installments->save();

        $trans = new Transaction();
        $trans->transaction_date = Carbon::now();
        $trans->amount = '';
        $trans->balance = $installments->outstanding_balance;
        $trans->installment_balance = $installments->installment_year;
        $trans->status = 'Paid';
        $trans->installment_id = $installments->id;
        $trans->order_id = $order->id;
        $trans->customer_id = $order->customer->id;
        $trans->save();

        $order->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.orders.index');
    }
}
