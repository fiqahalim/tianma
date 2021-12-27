<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
            $ref_no = random_int(100000, 999999);
        } while (Order::where("ref_no", "=", $ref_no)->first());
  
        return $ref_no;
    }

    public function store(Order $order)
    {
        $customer = session('customer');
        $products = session('products');
        
        $orders = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->amount = $products->total_cost;
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = auth()->user()->id;
        $order->save();

        return view('pages.customer.order', compact('order'));
    }
}
