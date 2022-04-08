<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCommissionRequest;
use App\Http\Requests\StoreCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use App\Models\Commission;
use App\Models\Installment;
use App\Models\Order;
use App\Models\User;
use Gate;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommissionController extends Controller
{
    public function index(Order $order)
    {
        abort_if(Gate::denies('commission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['customer', 'team', 'createdBy', 'commissions'])->get();

        return view('admin.commissions.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('commission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments');
        session(['orders' => $order]);

        return view('admin.commissions.edit', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $orders = session('orders');

        $totalCommission = $installmentPV = 0;

        $rankings = isset($orders->createdBy) ? $orders->createdBy : '';
        $newPV = $request->point_value;
        $installmentMonths = $request->installment_year;

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

        // save to commission tables
        $comms = new Commission;
        $comms->mo_overriding_comm = $totalCommission;
        $comms->point_value = $request->point_value;
        $comms->order_id = $orders->id;
        $comms->user_id = $orders->createdBy->id;
        $comms->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.commissions.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('commission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments');

        $allCommissions = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
            ->where('commissions.order_id', $order->id)
            ->get(['commissions.*']);

        $firstPayout = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->where('commissions.order_id', $order->id)
            ->first();

        return view('admin.commissions.show', compact('order', 'allCommissions', 'firstPayout'));
    }

    public function destroy(Commission $commission)
    {
        abort_if(Gate::denies('commission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commission->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyCommissionRequest $request)
    {
        Commission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function commissionCalculator(Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments');
        session(['orders' => $order]);

        return view('admin.commissions.calculator', compact('order'));
    }

    public function commissionStore(Request $request, Order $order)
    {
        $orders = session('orders');

        $requestData = $request->all();

        $newPV = isset($requestData['point_value']) ? $requestData['point_value'] : null;
        $totalCommission = $installmentPV = 0;

        $rankings = isset($orders->createdBy) ? $orders->createdBy : '';
        $installmentMonths = isset($orders->installments->installment_year) ? $orders->installments->installment_year : '';

        // check method payment
        if ($orders->customer->mode == 'Installment') {
            $installmentPV = ($newPV);
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

        // save to commission tables
        $comms = new Commission;
        $comms->mo_overriding_comm = $totalCommission;
        $comms->actual_pv = $requestData['pv'];
        $comms->point_value = $requestData['point_value'];
        $comms->percentage = $requestData['percentage'];
        $comms->first_month = $requestData['first_month'];
        $comms->order_id = $orders->id;
        $comms->user_id = $orders->createdBy->id;
        $comms->save();

        return view('admin.commissions.results', compact('orders', 'comms'));
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
                // $commissions->order_id = $orders->id;
                $commissions->save();

                return $commissions;
            }
        }
    }
}
