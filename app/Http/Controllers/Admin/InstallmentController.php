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
use App\Models\Commission;
use App\Models\Transaction;
use Carbon\Carbon;

class InstallmentController extends Controller
{
    public function index(Request $request)
    {
        $products = session('products');
        $customer = session('customer');

        return view('pages.installment.index', compact('customer', 'products'));
    }

    private function getOrderNumber()
    {
        do {
            $ref_no = random_int(100000000, 999999999);
        } while (Order::where("ref_no", "=", $ref_no)->first());

        return $ref_no;
    }

    public function store(Request $request)
    {
        // $products = session('products');
        $customer = session('customer');
        $locations = session('bookLocation');

        $requestData = $request->all();

        $order = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->payment_option = 'PAY NOW';
        $order->amount = $requestData['amount'];
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = $customer->created_by;
        // $order->product_id = $products->id;
        $order->book_locations_id = $locations->id;
        $order->save();

        session(['order' => $order]);

        // payment mode calculation
        if ($customer->mode == 'Installment') {
            $installments = new Installment;
            $installments->downpayment = $requestData['downpayment'];
            $installments->amount = $requestData['amount'];
            $installments->outstanding_balance = $request['outstanding_balance'];
            $installments->monthly_installment = $request['monthly_installment'];
            $installments->last_month_payment = $request['last_month_payment'];
            $installments->installment_year = $request['installment_year'];
            $installments->created_at = Carbon::now();
            $installments->customer_id = $customer->id;
            $installments->created_by = $customer->created_by;
            $installments->order_id = $order->id;
            $installments->save();

            $trans = new Transaction();
            $trans->transaction_date = Carbon::now();
            // $trans->trans_no = $this->transactionNo();
            $trans->amount = '0.0';
            $trans->balance = $installments->outstanding_balance;
            $trans->installment_balance = $installments->installment_year;
            $trans->status = 'Paid';
            $trans->installment_id = $installments->id;
            $trans->order_id = $order->id;
            $trans->customer_id = $customer->id;
            $trans->save();

        }

        session(['paymentInfo' => $installments]);

        return view('pages.installment.result', compact('customer', 'order', 'installments'));
    }

    public function update(Request $request, $category, $childCategory, $childCategory2, Product $product, Installment $installment)
    {
        $products = session('products');
        $customer = session('customer');
        $locations = session('bookLocation');
        $installments = session('installments');

        $installment->update($request->all());
    }

    public function payLater(Request $request)
    {
        // $products = session('products');
        $customer = session('customer');
        $locations = session('bookLocation');

        $order = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->payment_option = 'PAY LATER';
        $order->amount = '0.0';
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = $customer->created_by;
        // $order->product_id = $products->id;
        $order->expiry_date = $current = Carbon::now()->addDays(4)->hour(10)->minute(00)->second(0)->toDateTimeString();
        $order->book_locations_id = $locations->id;
        $order->save();

        session(['order' => $order]);

        return view('pages.includes.pay-later-order', compact('order', 'customer'));
    }
}
