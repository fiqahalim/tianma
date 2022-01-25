<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\ProductCategory;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $customer = session('customer');

        return view('pages.customer.order');
    }

    public function getOrderNumber()
    {
        do {
            $ref_no = random_int(100000000, 999999999);
        } while (Order::where("ref_no", "=", $ref_no)->first());
  
        return $ref_no;
    }

    public function store(Order $order)
    {
        $customer = session('customer');
        $products = session('products');
        $pv = session('products')['point_value'];

        $totalProductAmount = 0;
        $totalProductAmount += $products->total_cost * $pv;
        
        $orders = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->amount = $totalProductAmount;
        $order->order_date = $current = Carbon::now('+08:00');
        $order->customer_id = $customer->id;
        $order->created_by = auth()->user()->id;
        $order->save();

        return view('pages.customer.order', compact('order'));
    }
}
