<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use App\Models\Commission;

use Carbon\Carbon;

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
        // Admin View
        $agents = User::where('approved', '=', 0)
            ->get()
            ->count();

        $orders = Order::where('approved', '=', 0)
            ->get()
            ->count();

        $allOrders = Order::with(['commissions', 'customer'])->get();

        // Agent View
        $customers = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
            ->where('orders.created_by', auth()->user()->id)
            ->where('orders.approved', '=', 1)
            ->count();

        $agentComms = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
            ->where('commissions.user_id', auth()->user()->id)
            ->get(['orders.*', 'commissions.mo_overriding_comm']);

        $myEarnings = Commission::where('commissions.user_id', auth()->user()->id)
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->sum('commissions.mo_overriding_comm');

        $myOrders = Order::where([
                ['created_by', auth()->user()->id]
            ])
            ->where('approved', '=', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $payLaters = Order::where([
                ['created_by', auth()->user()->id]
            ])
            ->where('payment_option', '=', 'PAY LATER')
            ->get();

        return view('home', compact(
            'customers', 'agents',
            'orders', 'allOrders',
            'agentComms', 'myEarnings', 'myOrders', 'payLaters'
        ));
    }

    public function help()
    {
        return view('pages.help.help');
    }
}
