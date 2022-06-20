<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use NumberToWords\NumberToWords;

class OrderDetailsController extends Controller
{
    public function index()
    {
        $myOrders = Order::where([
                ['created_by', auth()->user()->id]
            ])
            ->get();

        return view('pages.order.index', compact('myOrders'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        $order->load('customer', 'createdBy', 'products', 'bookLocations', 'installments', 'fullPayments');

        if($order->customer->mode == 'Installment') {
            $amount = isset($order->installments->downpayment) ? $order->installments->downpayment : '0.00';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        } else {
            $amount = isset($order->amount) ? $order->amount : null;
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);

            $today = Carbon::today();
            $date = $today->addMonth(1);
        }

        return view('pages.order.show', compact('order', 'date', 'amountFormat'));
    }

    public function edit()
    {

    }
}
