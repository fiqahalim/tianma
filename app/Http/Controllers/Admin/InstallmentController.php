<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Installment;
use App\Models\Customer;
use Carbon\Carbon;

class InstallmentController extends Controller
{
    public function index()
    {
        $products = session('products');
        $customer = session('customer');

        return view('pages.installment.index', compact('customer', 'products'));
    }

    public function store()
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
}
