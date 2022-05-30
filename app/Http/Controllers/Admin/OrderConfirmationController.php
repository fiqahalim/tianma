<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\PaymentMonthly;
use App\Models\Customer;
use App\Models\Commission;
use Carbon\Carbon;

class OrderConfirmationController extends Controller
{
    public function orderPage()
    {
        $products = session('products');
        $customer = session('customer');

        return view('pages.customer.order', compact('customer', 'products'));
    }

    public function invoice()
    {
        $products = session('products');
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
        // $products = session('products');
        $customer = session('customer');
        $locations = session('bookLocation');

        // $pv = session('products')['point_value'];

        $totalProductAmount = 0;
        $sst = 6;
        // $totalProductAmount = ($products->total_cost) + ($products->total_cost * ($sst/100));

        $orders = new Order;
        $order->ref_no = $this->getOrderNumber();
        $order->order_status = 'NEW';
        // $order->amount = $totalProductAmount;
        $order->order_date = $current = Carbon::now();
        $order->customer_id = $customer->id;
        $order->created_by = $customer->created_by;
        // $order->product_id = $products->id;
        $order->book_locations_id = $locations->id;
        $order->save();

        session(['order' => $order]);

        // payment mode calculation
        if ($customer->mode == 'Full Payment') {
            $paymentInfo = $this->fullpaymentCalculate();
        }

        return view('pages.customer.order', compact('order', 'customer', 'paymentInfo'));
    }

    private function fullpaymentCalculate()
    {
        $cust = session('customer');

        $odr = Order::select('amount', 'id')
            ->latest()->first();

        // stored into transactions
        $fullpays = null;
        $fullpays = new PaymentMonthly;
        $fullpays->amount = $odr->amount;
        $fullpays->customer_id = $cust->id;
        $fullpays->created_by = $cust->created_by;
        $fullpays->order_id = $odr->id;
        $fullpays->save();

        return $fullpays;
    }

    /**
     * Calculate commission based on agent ranking
     * also the parent commissions
    */
    private function commissions()
    {
        // $pv = session('products')['point_value'];
        $cust = session('customer');
        $existCust = session('searchCust');

        $totalCommission = 0;

        $odr = Order::select('amount', 'id')
                ->latest()->first();

        $rankings = User::select('ranking_id')
                ->where('id', $cust->created_by)
                ->first();

        switch ($rankings->ranking_id) {
            case 1:
                $totalCommission += round((8000 * 0.16), 2);
                $parentCommission = $this->getParent();
                $pp = $this->getPP();
                break;
            case 2:
                $totalCommission += round((8000 * 0.04), 2);
                $parentCommission = $this->getParent();
                $pp = $this->getPP();
                break;
            case 3:
                $totalCommission += round((8000 * 0.02), 2);
                $parentCommission = $this->getParent();
                $pp = $this->getPP();
                break;
            case 4:
                $totalCommission += round((8000 * 0.04),2);
                $parentCommission = $this->getParent();
                $pp = $this->getPP();
                break;
            case 5:
                $totalCommission += round((8000 * 0.05), 2);
                $parentCommission = $this->getParent();
                $pp = $this->getPP();
                break;
            default:
                break;
        }

        $commissions = null;
        $commissions = new Commission;
        $commissions->mo_overriding_comm = $totalCommission;
        $commissions->created_at = $current = Carbon::now();
        $commissions->user_id = $cust->created_by;
        $commissions->order_id = $odr->id;
        $commissions->save();

        return $commissions;
    }
}
