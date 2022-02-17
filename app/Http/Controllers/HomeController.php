<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::where('created_by', auth()->user()->id)
            ->count();

        $agents = User::where('approved', '=', 0)
            ->get()
            ->count();

        $orders = Order::where('approved', '=', 0)
            ->get()
            ->count();

        $allOrders = Order::with(['commissions', 'customer'])->get();

        $agentComms = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
            ->where('orders.created_by', auth()->user()->id)
            ->where('commissions.user_id', auth()->user()->id)
            ->get(['orders.*', 'commissions.mo_overriding_comm']);

        return view('home', compact('customers','agents','orders', 'allOrders', 'agentComms'));
    }

    public function help()
    {
        return view('pages.help.help');
    }
}
