<?php

namespace App\Http\Controllers\User;

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

class OrderController extends Controller
{
    public function orderPage()
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
        $order->created_by = auth()->user()->id;
        $order->save();

        // payment mode calculation
        if ($customer->mode == 'installment') {
            $paymentInfo = $this->installmentCalculate();
            $commissions = $this->commissions();
        } else {
            $paymentInfo = $this->fullpaymentCalculate();
            $commissions = $this->commissions();
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
        $installments->created_by = auth()->user()->id;
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
        $tr->created_by = auth()->user()->id;
        $tr->order_id = $odr->id;
        $tr->save();

        return $tr;
    }

    /**
     * Calculate commission based on agent ranking
     * also the parent commissions
    */
    private function commissions()
    {
        $pv = session('products')['point_value'];

        $totalCommission = 0;

        // commission
        $rankings = User::select('ranking_id')
            ->where('id', auth()->user()->id)
            ->first();

        $team = User::select('team_id')
            ->where('id', auth()->user()->id)
            ->first();

        $odr = Order::select('amount', 'id')
            ->latest()->first();

        switch ($rankings->ranking_id) {
            case 1:
                $totalCommission += round(($pv * 0.16), 2);
                $parentCommission = $this->getParent();
                break;
            case 2:
                $totalCommission += round(($pv * 0.04), 2);
                $parentCommission = $this->getParent();
                break;
            case 3:
                $totalCommission += round(($pv * 0.02), 2);
                $parentCommission = $this->getParent();
                break;
            case 4:
                $totalCommission += round(($pv * 0.04),2);
                $parentCommission = $this->getParent();
                break;
            case 5:
                $totalCommission += round(($pv * 0.05), 2);
                $parentCommission = $this->getParent();
                break;
            default:
                break;
        }

        /**
         * Stored in commission tables
         **/
        $commissions = null;
        $commissions = new Commission;
        $commissions->mo_overriding_comm = $totalCommission;
        $commissions->created_at = $current = Carbon::now();
        $commissions->user_id = auth()->user()->id;
        $commissions->order_id = $odr->id;
        $commissions->team_id = $team->id ?? 'NULL';
        $commissions->save();

        return $commissions;
    }

    // calling the getparent function
    public function getParent()
    {
        $pv = session('products')['point_value'];

        $totalCommission = 0;

        $user = User::select('ranking_id', 'id', 'parent_id')
            ->where('id', auth()->user()->id)->first();

        $odr = Order::select('amount', 'id')
            ->latest()->first();

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
        $commissions->team_id = $team->id ?? 'NULL';
        $commissions->save();

        return $commissions;
    }
}
