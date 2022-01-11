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

        $allOrders = Order::get();

        $myComms = Order::where('created_by', auth()->user()->id)
            ->get();

        $amounts = OrderItem::select('amount')
            ->where('user_id', auth()->user()->id)
            ->get();

        $myAmount = 0;
        foreach($amounts as $keys => $amount) {
            $myAmount = $amount['amount'];
        }

        return view('home', compact('customers','agents','myAmount', 'orders', 'allOrders', 'myComms'));
    }

    public function help()
    {
        return view('pages.help.help');
    }
}
