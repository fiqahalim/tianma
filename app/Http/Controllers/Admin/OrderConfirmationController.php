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
        $existCust = session('searchCust');

        return view('pages.customer.order');
    }

    public function invoice()
    {
        $customer = session('customer');
        $existCust = session('searchCust');

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
        $existCust = session('searchCust');

        $pv = session('products')['point_value'];

        $totalProductAmount = 0;
        $totalProductAmount += $products->total_cost;

        if (!is_null($existCust)) {
            foreach($existCust as $ec) {

                $orders = new Order;
                $order->ref_no = $this->getOrderNumber();
                $order->order_status = 'NEW';
                $order->amount = $totalProductAmount;
                $order->order_date = $current = Carbon::now();
                $order->customer_id = $ec->id;
                $order->created_by = $ec->created_by;
                $order->product_id = $products->id;
                $order->save();

                // payment mode calculation
                if ($ec->mode == 'Full Payment') {
                    $paymentInfo = $this->fullpaymentCalculate();
                    $commissions = $this->commissions();
                }
            }
        } else {
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
            if ($customer->mode == 'Full Payment') {
                $paymentInfo = $this->fullpaymentCalculate();
                $commissions = $this->commissions();
            }
        }

        return view('pages.customer.order', compact('order', 'customer', 'paymentInfo'));
    }

    private function fullpaymentCalculate()
    {
        $cust = session('customer');
        $existCust = session('searchCust');

        $odr = Order::select('amount', 'id')
            ->latest()->first();

        if (!is_null($existCust)) {
            foreach($existCust as $ec) {
                // stored into transactions
                $tr = null;
                $tr = new Transaction;
                $tr->amount = $odr->amount;
                $tr->transaction_date = $current = Carbon::now();
                $tr->customer_id = $ec->id;
                $tr->created_by = $ec->created_by;
                $tr->order_id = $odr->id;
                $tr->save();
            }
        } else {
            // stored into transactions
            $tr = null;
            $tr = new Transaction;
            $tr->amount = $odr->amount;
            $tr->transaction_date = $current = Carbon::now();
            $tr->customer_id = $cust->id;
            $tr->created_by = $cust->created_by;
            $tr->order_id = $odr->id;
            $tr->save();
        }

        return $tr;
    }

    /**
     * Calculate commission based on agent ranking
     * also the parent commissions
    */
    private function commissions()
    {
        $pv = session('products')['point_value'];
        $cust = session('customer');
        $existCust = session('searchCust');

        $totalCommission = 0;

        $odr = Order::select('amount', 'id')
                ->latest()->first();

        if(!is_null($existCust)) {
            foreach($existCust as $ec) {
                $rankings = User::select('ranking_id')
                    ->where('id', $ec->created_by)
                    ->first();

                switch ($rankings->ranking_id) {
                    case 1:
                        $totalCommission += round(($pv * 0.16), 2);
                        $parentCommission = $this->getParent();
                        $pp = $this->getPP();
                        break;
                    case 2:
                        $totalCommission += round(($pv * 0.04), 2);
                        $parentCommission = $this->getParent();
                        $pp = $this->getPP();
                        break;
                    case 3:
                        $totalCommission += round(($pv * 0.02), 2);
                        $parentCommission = $this->getParent();
                        $pp = $this->getPP();
                        break;
                    case 4:
                        $totalCommission += round(($pv * 0.04),2);
                        $parentCommission = $this->getParent();
                        $pp = $this->getPP();
                        break;
                    case 5:
                        $totalCommission += round(($pv * 0.05), 2);
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
                $commissions->user_id = $ec->created_by;
                $commissions->order_id = $odr->id;
                $commissions->save();
            }
        } else {
            $rankings = User::select('ranking_id')
                ->where('id', $cust->created_by)
                ->first();

            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($pv * 0.16), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 2:
                    $totalCommission += round(($pv * 0.04), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 3:
                    $totalCommission += round(($pv * 0.02), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 4:
                    $totalCommission += round(($pv * 0.04),2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 5:
                    $totalCommission += round(($pv * 0.05), 2);
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
        }

        return $commissions;
    }

    // calling the getparent function
    public function getParent()
    {
        $pv = session('products')['point_value'];
        $cust = session('customer');
        $existCust = session('searchCust');

        $totalCommission = 0;

        $user = User::select('ranking_id', 'id', 'parent_id')
            ->where('id', $cust->created_by)->first();

        $odr = Order::select('amount', 'id')
            ->latest()->first();

        $p = User::where('id', $user->parent_id)->with('parent')->get();

        if(!empty($user->parent_id)) {
            $parent = User::select('ranking_id')->where('id', $user->parent_id)->first();
            if($parent->ranking_id !== $user->ranking_id) {
                // switch statement
                switch ($parent->ranking_id) {
                    case 1:
                        $totalCommission += round(($pv * 0.16), 2);
                        break;
                    case 2:
                        $totalCommission += round(($pv * 0.04), 2);
                        break;
                    case 3:
                        $totalCommission += round(($pv * 0.02), 2);
                        break;
                    case 4:
                        $totalCommission += round(($pv * 0.04),2);
                        break;
                    case 5:
                        $totalCommission += round(($pv * 0.05), 2);
                        break;
                    default:
                        break;
                }
            }
        }

        $commissions = null;
        $commissions = new Commission;
        $commissions->mo_overriding_comm = $totalCommission;
        $commissions->created_at = $current = Carbon::now();
        $commissions->user_id = $user->parent_id;
        $commissions->order_id = $odr->id;
        $commissions->save();

        return $commissions;
    }

    public function getPP()
    {
        $pv = session('products')['point_value'];
        $cust = session('customer');
        $existCust = session('searchCust');

        $totalCommission = 0;

        $user = User::select('ranking_id', 'id', 'parent_id')
            ->where('id', $cust->created_by)->first();

        $odr = Order::select('amount', 'id')
            ->latest()->first();

        $p = User::where('id', $user->parent_id)->with('parent')->get();

        if(isset($p) && !empty($p)) {
            foreach ($p as $pss) {
                if (!empty($pss->parent_id)) {
                    $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                    if ($pRank->ranking_id !== $pss->ranking_id) {
                        switch ($pRank->ranking_id) {
                            case 1:
                                $totalCommission += round(($pv * 0.16), 2);
                                break;
                            case 2:
                                $totalCommission += round(($pv * 0.04), 2);
                                break;
                            case 3:
                                $totalCommission += round(($pv * 0.02), 2);
                                break;
                            case 4:
                                $totalCommission += round(($pv * 0.04),2);
                                break;
                            case 5:
                                $totalCommission += round(($pv * 0.05), 2);
                                break;
                            default:
                                break;
                        }
                    }
                }

                $commissions = null;
                $commissions = new Commission;
                $commissions->mo_overriding_comm = $totalCommission;
                $commissions->created_at = $current = Carbon::now();
                $commissions->user_id = $pss->parent_id;
                $commissions->order_id = $odr->id;
                $commissions->save();

                return $commissions;
            }
        }
    }
}
