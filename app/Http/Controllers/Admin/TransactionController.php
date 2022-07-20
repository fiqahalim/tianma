<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyPaymentMonthlyRequest;
use App\Http\Requests\StorePaymentMonthlyRequest;
use App\Http\Requests\UpdatePaymentMonthlyRequest;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\Installment;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Alert;
use DB;

class TransactionController extends Controller
{
    public function index(Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments', 'transactions');
        session(['orders' => $order]);

        $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->get(['transactions.*']);

        return view('admin.paymentMonthlies.index', compact('order', 'transactions'));
    }

    public function store(Request $request, Order $order)
    {
        $orders = session('orders');

        $order->load('customer', 'commissions', 'installments', 'transactions', 'createdBy');

        $balances = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->latest('transactions.created_at')
            ->take(1)->get()->sum('balance');

        $installmentB = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->latest('transactions.created_at')
            ->take(1)->get()->sum('installment_balance');

        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $newBalance = $installmentBalance = $totalCommission = $installmentPV = 0;
        $amount = isset($request->amount) ? $request->amount: '';
        $rankings = isset($orders->createdBy) ? $orders->createdBy : '';
        $newBalance = ($balances - $amount);
        $newPV = $request->point_value;
        $installmentMonths = $request->installment_year;
        $installmentBalance = ($installmentB - 1);

        // dd($order, $rankings, session()->all());

        // check method payment
        if ($orders->customer->mode == 'Installment') {
            $installmentPV = ($newPV / $installmentMonths);
            session(['installmentPV' => $installmentPV]);

            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($installmentPV * 0.16), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 2:
                    $totalCommission += round(($installmentPV * 0.04), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 3:
                    $totalCommission += round(($installmentPV * 0.02), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 4:
                    $totalCommission += round(($installmentPV * 0.04),2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 5:
                    $totalCommission += round(($installmentPV * 0.05), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                default:
                    break;
            }
        } else {
            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($newPV * 0.16), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 2:
                    $totalCommission += round(($newPV * 0.04), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 3:
                    $totalCommission += round(($newPV * 0.02), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 4:
                    $totalCommission += round(($newPV * 0.04),2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                case 5:
                    $totalCommission += round(($newPV * 0.05), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    break;
                default:
                    break;
            }
        }

        // save monthly transaction
        $transaction = new Transaction();
        $transaction->transaction_date = Carbon::now();
        // $transaction->trans_no = $this->transactionNo();
        $transaction->amount = $amount;
        $transaction->status = $request->status;
        $transaction->balance = $newBalance;
        $transaction->installment_balance = $installmentBalance;
        $transaction->order_id = $order->id;
        $transaction->installment_id = $order->installments->id;
        $transaction->save();

        // save to commission tables
        $comms = new Commission;
        $comms->mo_overriding_comm = $totalCommission;
        $comms->point_value = $request->point_value;
        $comms->order_id = $orders->id;
        $comms->user_id = $orders->createdBy->id;
        $comms->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.transaction.index', [$order->id]);
    }

    public function transactionNo()
    {
        do {
            $trans_no = random_int(100000000, 999999999);
        } while (Transaction::where("trans_no", "=", $trans_no)->first());

        return $trans_no;
    }

    public function filter(Request $request, Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments', 'transactions');

        $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
            ->where('transactions.order_id', '=', $order->id)
            ->get(['transactions.*']);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = DB::table('transactions')->select()
            ->where('transaction_date', '>=', $fromDate)
            ->where('transaction_date', '<=', $toDate)
            ->get();

        return view('admin.paymentMonthlies.index', compact('order', 'transactions', 'query'));
    }

    // calling the getparent function
    public function getParent()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        $totalCommission = 0;

        if(!empty($user->parent_id)) {
            $parent = User::select('ranking_id')->where('id', $user->parent_id)->first();
            if($parent->ranking_id !== $user->ranking_id) {
                // switch statement
                switch ($parent->ranking_id) {
                    case 1:
                        $totalCommission += round(($installmentPV * 0.16), 2);
                        break;
                    case 2:
                        $totalCommission += round(($installmentPV * 0.04), 2);
                        break;
                    case 3:
                        $totalCommission += round(($installmentPV * 0.02), 2);
                        break;
                    case 4:
                        $totalCommission += round(($installmentPV * 0.04),2);
                        break;
                    case 5:
                        $totalCommission += round(($installmentPV * 0.05), 2);
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
        // $commissions->order_id = $orders->id;
        $commissions->save();

        return $commissions;
    }

    public function getPP()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        $p = User::where('id', $user->parent_id)->with('parent')->get();

        $totalCommission = 0;

        if(isset($p) && !empty($p)) {
            foreach ($p as $pss) {
                if (!empty($pss->parent_id)) {
                    $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                    if ($pRank->ranking_id !== $pss->ranking_id) {
                        switch ($pRank->ranking_id) {
                            case 1:
                                $totalCommission += round(($installmentPV * 0.16), 2);
                                break;
                            case 2:
                                $totalCommission += round(($installmentPV * 0.04), 2);
                                break;
                            case 3:
                                $totalCommission += round(($installmentPV * 0.02), 2);
                                break;
                            case 4:
                                $totalCommission += round(($installmentPV * 0.04),2);
                                break;
                            case 5:
                                $totalCommission += round(($installmentPV * 0.05), 2);
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
                $commissions->save();

                return $commissions;
            }
        }
    }
}
