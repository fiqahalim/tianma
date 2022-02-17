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
        $customers = Customer::where('created_by', auth()->user()->id)
            ->count();

        $agentComms = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
            ->where('orders.created_by', auth()->user()->id)
            ->where('commissions.user_id', auth()->user()->id)
            ->get(['orders.*', 'commissions.mo_overriding_comm']);

        $myEarnings = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->where('orders.created_by', auth()->user()->id)
            ->where('commissions.user_id', auth()->user()->id)
            ->where('orders.approved', '=', 1)
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->sum('commissions.mo_overriding_comm');

        $myOrders = Order::where([
                ['created_by', auth()->user()->id]
            ])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->count();

        return view('home', compact(
            'customers', 'agents',
            'orders', 'allOrders',
            'agentComms', 'myEarnings', 'myOrders'
        ));
    }

    public function help()
    {
        return view('pages.help.help');
    }
}
