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
use NumberToWords\NumberToWords;

class TransactionController extends Controller
{
    public function index(Request $request, Order $order)
    {
        $order->load('customer', 'createdBy', 'commissions', 'installments', 'transactions');
        session(['orders' => $order]);

        if ($request->start_date || $request->end_date) {
            $end_date = [];
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();

            $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
                ->where('transactions.order_id', '=', $order->id)
                ->whereBetween('transaction_date', [$start_date, $end_date])
                ->get(['transactions.*']);
        } else {
            $transactions = Order::join('transactions', 'transactions.order_id', '=', 'orders.id')
                ->where('transactions.order_id', '=', $order->id)
                ->get(['transactions.*']);
        }

        return view('admin.paymentMonthlies.index', compact('order', 'transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('customer', 'installments', 'orders');

        if($transaction->amount > 0) {
            $amount = isset($transaction->amount) ? $transaction->amount : '';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);
        } else {
            $amount = isset($transaction->installments->downpayment) ? $transaction->installments->downpayment : '';
            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('en');
            $amountFormat = $numberTransformer->toWords($amount);
        }

        return view('admin.paymentMonthlies.show', compact('transaction', 'amountFormat'));
    }

    public function update(Request $request, Order $order)
    {
        $order->load('customer', 'createdBy', 'commissions', 'installments', 'transactions');

        $newBalancePV = ($order->commissions->actual_pv) - ($order->commissions->point_value);

        return view('admin.paymentMonthlies.edit', compact('order', 'newBalancePV'));
    }

    // monthly installment store
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

        $newBalance = $installmentBalance = $totalCommission = $installmentPV = $balanceCommission = $prevPVs = 0;

        $amount = isset($request->amount) ? $request->amount: '';
        $rankings = isset($orders->createdBy) ? $orders->createdBy : '';
        $newBalance = ($balances - $amount);
        $newPV = isset($request->balance_pv) ? $request->balance_pv: '';
        $installmentMonths = $request->installment_year;
        $installmentBalance = ($installmentB - 1);

        // check method payment
        if ($orders->customer->mode == 'Installment') {
            $installmentPV = ($newPV / $installmentMonths);
            $prevPVs = $installmentPV * ($installmentMonths - 1);
            $balanceComms = $newPV - $prevPVs;

            $spinOff = 0;
            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                ->where('commissions.user_id', $order->created_by)
                ->sum('commissions.mo_overriding_comm');

            session(['installmentPV' => $installmentPV]);
            session(['balanceComms' => $balanceComms]);

            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($installmentPV * 0.16), 2);
                    $balanceCommission += round(($balanceComms * 0.16), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 2:
                    $totalCommission += round(($installmentPV * 0.04), 2);
                    $balanceCommission += round(($balanceComms * 0.04), 2);
                    if ($monthlySpinOff >= 50000) {
                       $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                    }
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 3:
                    $totalCommission += round(($installmentPV * 0.02), 2);
                    $balanceCommission += round(($balanceComms * 0.02), 2);
                    if ($monthlySpinOff >= 150000) {
                       $spinOff += round(($monthlySpinOff * (1/100)), 2);
                    }
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 4:
                    $totalCommission += round(($installmentPV * 0.04),2);
                    $balanceCommission += round(($balanceComms * 0.04), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 5:
                    $totalCommission += round(($installmentPV * 0.05), 2);
                    $balanceCommission += round(($balanceComms * 0.05), 2);
                    if ($monthlySpinOff >= 900000) {
                       $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                    }
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
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
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 2:
                    $totalCommission += round(($newPV * 0.04), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 3:
                    $totalCommission += round(($newPV * 0.02), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 4:
                    $totalCommission += round(($newPV * 0.04),2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
                    break;
                case 5:
                    $totalCommission += round(($newPV * 0.05), 2);
                    $parentCommission = $this->getParent();
                    $pp = $this->getPP();
                    $ppp = $this->getPPP();
                    $pppp = $this->getPPPP();
                    $getFive = $this->getFiveP();
                    $getSixth = $this->getSixth();
                    $getSeven = $this->getSeven();
                    $getEight = $this->getEight();
                    $getNine = $this->getNine();
                    $getTen = $this->getTen();
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
        $transaction->customer_id = $order->customer->id;
        $transaction->save();

        // save to commission tables
        $comms = new Commission;
        $comms->mo_overriding_comm = abs($totalCommission);
        $comms->balance_comm = abs($balanceCommission);
        $comms->mo_spin_off = abs($spinOff);
        $comms->point_value = $orders->commissions->point_value;
        $comms->balance_pv = $newPV;
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

    // 1st parent
    public function getParent()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        $totalCommission = $balanceCommission = $spinOff = 0;

        if($orders->customer->mode == 'Installment') {
            if(!empty($user->parent_id)) {
                $parent = User::select('ranking_id')->where('id', $user->parent_id)->first();
                $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                    ->where('commissions.user_id', $user->parent_id)
                    ->sum('commissions.mo_overriding_comm');

                if($parent->ranking_id !== $user->ranking_id) {
                    // switch statement
                    switch ($parent->ranking_id) {
                        case 1:
                            $totalCommission += round(($installmentPV * 0.16), 2);
                            $balanceCommission += round(($balanceComms * 0.16), 2);
                            break;
                        case 2:
                            $totalCommission += round(($installmentPV * 0.04), 2);
                            $balanceCommission += round(($balanceComms * 0.04), 2);
                            if ($monthlySpinOff >= 50000) {
                                $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                            }
                            break;
                        case 3:
                            $totalCommission += round(($installmentPV * 0.02), 2);
                            $balanceCommission += round(($balanceComms * 0.02), 2);
                            if ($monthlySpinOff >= 150000) {
                                $spinOff += round(($monthlySpinOff * (1/100)), 2);
                            }
                            break;
                        case 4:
                            $totalCommission += round(($installmentPV * 0.04),2);
                            $balanceCommission += round(($balanceComms * 0.04), 2);
                            break;
                        case 5:
                            $totalCommission += round(($installmentPV * 0.05), 2);
                            $balanceCommission += round(($balanceComms * 0.05), 2);
                            if ($monthlySpinOff >= 900000) {
                                $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } else {
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
                            if ($monthlySpinOff >= 50000) {
                                $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                            }
                            break;
                        case 3:
                            $totalCommission += round(($installmentPV * 0.02), 2);
                            if ($monthlySpinOff >= 50000) {
                                $spinOff += round(($monthlySpinOff * (1/100)), 2);
                            }
                            break;
                        case 4:
                            $totalCommission += round(($installmentPV * 0.04),2);
                            break;
                        case 5:
                            $totalCommission += round(($installmentPV * 0.05), 2);
                            if ($monthlySpinOff >= 900000) {
                                $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        $commissions = null;
        $commissions = new Commission;
        $commissions->mo_overriding_comm = abs($totalCommission);
        $commissions->balance_comm = abs($balanceCommission);
        $commissions->mo_spin_off = abs($spinOff);
        $commissions->created_at = $current = Carbon::now();
        $commissions->order_id = $orders->id;
        $commissions->user_id = $user->parent_id;
        $commissions->save();

        return $commissions;
    }

    // calling the 2nd parent
    public function getPP()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        $p = User::where('id', $user->parent_id)->with('parent')->get();

        $totalCommission = $balanceCommission = 0;

        if($orders->customer->mode == 'Installment') {
            if(isset($p) && !empty($p)) {
                foreach ($p as $pss) {
                    if (!empty($pss->parent_id)) {
                        $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                        $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                            ->where('commissions.user_id', $pss->parent_id)
                            ->sum('commissions.mo_overriding_comm');

                        $spinOff = 0;

                        if ($pRank->ranking_id !== $user->ranking_id) {
                            switch ($pRank->ranking_id) {
                                case 1:
                                    $totalCommission += round(($installmentPV * 0.16), 2);
                                    $balanceCommission += round(($balanceComms * 0.16), 2);
                                    break;
                                case 2:
                                    $totalCommission += round(($installmentPV * 0.04), 2);
                                    $balanceCommission += round(($balanceComms * 0.04), 2);
                                    if ($monthlySpinOff >= 50000) {
                                        $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                    }
                                    break;
                                case 3:
                                    $totalCommission += round(($installmentPV * 0.02), 2);
                                    $balanceCommission += round(($balanceComms * 0.02), 2);
                                    if ($monthlySpinOff >= 150000) {
                                        $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                    }
                                    break;
                                case 4:
                                    $totalCommission += round(($installmentPV * 0.04),2);
                                    $balanceCommission += round(($balanceComms * 0.04), 2);
                                    break;
                                case 5:
                                    $totalCommission += round(($installmentPV * 0.05), 2);
                                    $balanceCommission += round(($balanceComms * 0.05), 2);
                                    if ($monthlySpinOff >= 900000) {
                                        $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                    }
                                    break;
                                default:
                                    break;
                            }
                        }
                    }

                    $commissions = null;
                    $commissions = new Commission;
                    $commissions->mo_overriding_comm = abs($totalCommission);
                    $commissions->balance_comm = abs(isset($balanceCommission)) ? abs($balanceCommission) : '';
                    $commissions->mo_spin_off = abs($spinOff);
                    $commissions->created_at = $current = Carbon::now();
                    $commissions->order_id = $orders->id;
                    $commissions->user_id = $pss->parent_id;
                    $commissions->save();

                    return $commissions;
                }
            }
        }
    }

    // 3rd parent
    public function getPPP()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent) && !is_null($user->parent)) {
            $p = User::where('id', $user->parent->parent_id)->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 4th parent
    public function getPPPP()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent) && !is_null($user->parent->parent)) {
            $p = User::where('id', $user->parent->parent->parent_id)->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 5th parent
    public function getFiveP()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent) && !is_null($user->parent->parent->parent)) {
            $p = User::where('id', $user->parent->parent->parent->parent_id)->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 6th parent
    public function getSixth()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent->parent) && !is_null($user->parent->parent->parent->parent)) {
            $p = User::where('id', $user->parent->parent->parent->parent->parent_id)->with('parent')->get();

            $totalCommission = $balanceCommission = $spinOff = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 7th parent
    public function getSeven()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent->parent->parent) && !is_null($user->parent->parent->parent->parent->parent)) {

            $p = User::where('id', $user->parent->parent->parent->parent->parent->parent_id)->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 8th parent
    public function getEight()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent->parent->parent->parent) && !is_null($user->parent->parent->parent->parent->parent->parent)) {
            $p = User::where('id', $user->parent->parent->parent->parent->parent->parent->parent_id)
                ->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 9th parent
    public function getNine()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent->parent->parent->parent->parent) && !is_null($user->parent->parent->parent->parent->parent->parent->parent)) {

            $p = User::where('id', $user->parent->parent->parent->parent->parent->parent->parent->parent_id)
                ->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }

    // 10th parent
    public function getTen()
    {
        $orders = session('orders');
        $installmentPV = session('installmentPV');
        $balanceComms = session('balanceComms');

        $user = isset($orders->createdBy) ? $orders->createdBy : '';

        if(isset($user->parent->parent->parent->parent->parent->parent->parent->parent) && !is_null($user->parent->parent->parent->parent->parent->parent->parent->parent)) {

            $p = User::where('id', $user->parent->parent->parent->parent->parent->parent->parent->parent->parent_id)
                ->with('parent')->get();

            $totalCommission = $balanceCommission = 0;

            if($orders->customer->mode == 'Installment') {
                if(isset($p) && !empty($p)) {
                    foreach ($p as $pss) {
                        if (!empty($pss->parent_id)) {
                            $pRank = User::select('ranking_id')->where('id', $pss->parent_id)->first();
                            $monthlySpinOff = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
                                ->where('commissions.user_id', $pss->parent_id)
                                ->sum('commissions.mo_overriding_comm');

                            $spinOff = 0;

                            if ($pRank->ranking_id !== $user->ranking_id) {
                                switch ($pRank->ranking_id) {
                                    case 1:
                                        $totalCommission += round(($installmentPV * 0.16), 2);
                                        $balanceCommission += round(($balanceComms * 0.16), 2);
                                        break;
                                    case 2:
                                        $totalCommission += round(($installmentPV * 0.04), 2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        if ($monthlySpinOff >= 50000) {
                                            $spinOff += round(($monthlySpinOff * (1.6/100)), 2);
                                        }
                                        break;
                                    case 3:
                                        $totalCommission += round(($installmentPV * 0.02), 2);
                                        $balanceCommission += round(($balanceComms * 0.02), 2);
                                        if ($monthlySpinOff >= 150000) {
                                            $spinOff += round(($monthlySpinOff * (1/100)), 2);
                                        }
                                        break;
                                    case 4:
                                        $totalCommission += round(($installmentPV * 0.04),2);
                                        $balanceCommission += round(($balanceComms * 0.04), 2);
                                        break;
                                    case 5:
                                        $totalCommission += round(($installmentPV * 0.05), 2);
                                        $balanceCommission += round(($balanceComms * 0.05), 2);
                                        if ($monthlySpinOff >= 900000) {
                                            $spinOff += round(($monthlySpinOff * (0.5/100)), 2);
                                        }
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }

                        $commissions = null;
                        $commissions = new Commission;
                        $commissions->mo_overriding_comm = abs($totalCommission);
                        $commissions->balance_comm = isset($balanceCommission) ? $balanceCommission : '';
                        $commissions->mo_spin_off = abs($spinOff);
                        $commissions->created_at = $current = Carbon::now();
                        $commissions->order_id = $orders->id;
                        $commissions->user_id = $pss->parent_id;
                        $commissions->save();

                        return $commissions;
                    }
                }
            }
        }
    }
}
