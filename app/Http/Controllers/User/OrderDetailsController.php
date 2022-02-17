<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

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
        // dd($order);

        return view('pages.order.show', compact('order'));
    }

    public function edit()
    {

    }
}
