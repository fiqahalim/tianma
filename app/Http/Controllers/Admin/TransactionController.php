<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyPaymentMonthlyRequest;
use App\Http\Requests\StorePaymentMonthlyRequest;
use App\Http\Requests\UpdatePaymentMonthlyRequest;
use App\Models\Transaction;
use App\Models\Order;
use Carbon\Carbon;
use Alert;

class TransactionController extends Controller
{
    public function index(Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments', 'transactions');

        $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->get(['transactions.*']);

        return view('admin.paymentMonthlies.index', compact('order', 'transactions'));
    }

    public function store(Request $request, Order $order)
    {
        $order->load('customer', 'commissions', 'installments', 'transactions');

        $balances = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->latest('transactions.transaction_date')
            ->take(1)->get()->sum('balance');

        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $newBalance = 0;
        $amount = isset($request->amount) ? $request->amount: '';
        $newBalance = ($balances - $amount);

        $transaction = new Transaction();
        $transaction->transaction_date = Carbon::now();
        $transaction->amount = $amount;
        $transaction->status = $request->status;
        $transaction->balance = $newBalance;
        $transaction->order_id = $order->id;
        $transaction->installment_id = $order->installments->id;
        $transaction->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.transaction.index', [$order->id]);
    }

    public function update(UpdatePaymentMonthlyRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('admin.payment-monthlies.index');
    }

    public function show(Transaction $transaction)
    {
        return view('admin.paymentMonthlies.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentMonthlyRequest $request)
    {
        Transaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
