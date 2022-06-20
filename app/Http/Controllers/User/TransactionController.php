<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Commission;
use App\Models\Installment;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Alert;
use DB;
use NumberToWords\NumberToWords;

class TransactionController extends Controller
{
    public function index(Request $request, Order $order)
    {
        $order->load('customer', 'createdBy', 'commissions', 'installments', 'transactions');
        session(['orders' => $order]);

        if ($request->start_date || $request->end_date) {
            $end_date = [];
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
                ->where('transactions.order_id', '=', $order->id)
                ->whereBetween('transaction_date', [$start_date, $end_date])
                ->get(['transactions.*']);
        } else {
            $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
                ->where('transactions.order_id', '=', $order->id)
                ->get(['transactions.*']);
        }

        return view('pages.invoices.index', compact('order', 'transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('customer', 'installments', 'orders');

        if($transaction->amount > 0) {
            $amount = isset($transaction->amount) ? $transaction->amount : '';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);
        } else {
            $amount = isset($transaction->installments->downpayment) ? $transaction->installments->downpayment : '';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);
        }

        return view('pages.invoices.show', compact('transaction', 'amountFormat'));
    }
}
