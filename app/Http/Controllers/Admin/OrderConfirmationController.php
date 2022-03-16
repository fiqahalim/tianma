<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Installment;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Commission;
use Carbon\Carbon;

class OrderConfirmationController extends Controller
{
    public function orderPage()
    {
        $customer = session('customer');

        return view('pages.customer.order');
    }

    public function invoice()
    {
        $customer = session('customer');
        return view('pages.customer.order');
    }

    private function getOrderNumber()
    {
        do {
            $ref_no = random_int(100000000, 999999999);
        } while (Order::where("ref_no", "=", $ref_no)->first());

        return $ref_no;
    }

    public function store(Order $order)
    {
        $products = session('products');
        $customer = session('customer');
        $pv = session('products')['point_value'];

        $totalProductAmount = 0;
        $totalProductAmount += $products->total_cost;

        $orders = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->amount = $totalProductAmount;
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = $customer->created_by;
        $order->product_id = $products->id;
        $order->save();

        // payment mode calculation
        if ($customer->mode == 'Installment') {
            $paymentInfo = $this->installmentCalculatorPage();
            // $commissions = $this->commissions();
        } else {
            $paymentInfo = $this->fullpaymentCalculate();
            // $commissions = $this->commissions();
        }

        return view('pages.customer.order', compact('order', 'customer', 'paymentInfo'));
    }

    private function installmentCalculate()
    {
        $cust = session('customer');
        $odr = Order::select('amount', 'id')
            ->latest()->first();

        $outstanding_balance = $monthly_installment = $installment_balance = $downpayment = $totalCost = 0;

        $totalCost = $odr->amount;

        $downpayment = $totalCost * (20/100);
        $outstanding_balance = $totalCost - $downpayment;
        $monthly_installment = round($outstanding_balance / 12);
        $installment_balance = ($outstanding_balance - ($monthly_installment * 11));

        // stored into installments
        $installments = null;
        $installments = new Installment;
        $installments->downpayment = $downpayment;
        $installments->outstanding_balance = $outstanding_balance;
        $installments->monthly_installment = $monthly_installment;
        $installments->installment_balance = $installment_balance;
        $installments->created_at = Carbon::now();
        $installments->customer_id = $cust->id;
        $installments->created_by = $cust->created_by;
        $installments->order_id = $odr->id;
        $installments->save();

        return $installments;
    }

    private function fullpaymentCalculate()
    {
        $cust = session('customer');
        $odr = Order::select('amount', 'id')
            ->latest()->first();

        // stored into transactions
        $tr = null;
        $tr = new Transaction;
        $tr->amount = $odr->amount;
        $tr->transaction_date = $current = Carbon::now();
        $tr->customer_id = $cust->id;
        $tr->created_by = $cust->created_by;
        $tr->order_id = $odr->id;
        $tr->save();

        return $tr;
    }

    // installment Calculator Page
    public function installmentCalculatorPage()
    {
        return view('pages.installment.index');
    }
}
