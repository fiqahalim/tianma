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

    public function store(Request $request, $category, $childCategory, $childCategory2, Product $product)
    {
        $products = session('products');
        $customer = session('customer');
        $locations = session('bookLocation');

        $requestData = $request->all();

        $order = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        $order->amount = $requestData['amount'];
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = $customer->created_by;
        $order->product_id = $products->id;
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
            $installments->installment_year = $request['installment_year'];
            $installments->created_at = Carbon::now();
            $installments->customer_id = $customer->id;
            $installments->created_by = $customer->created_by;
            $installments->order_id = $order->id;
            $installments->save();

            $trans = new Transaction();
            $trans->transaction_date = Carbon::now();
            // $trans->trans_no = $this->transactionNo();
            $trans->amount = 0;
            $trans->balance = $installments->outstanding_balance;
            $trans->status = 'Paid';
            $trans->installment_id = $installments->id;
            $trans->order_id = $order->id;
            $trans->customer_id = $customer->id;
            $trans->save();

        }

        session(['paymentInfo' => $installments]);

        return view('pages.installment.result', compact('customer', 'products', 'order', 'installments'));
    }
}
