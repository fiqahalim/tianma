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

    public function create()
    {
        abort_if(Gate::denies('commission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('agent_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('ref_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.commissions.create', compact('orders', 'users'));
    }

    // public function store(Request $request, Commission $commission)
    // {
    //     $requestData = $request->all();

    //     $newPV = isset($requestData['point_value']) ? $requestData['point_value'] : null;

    //     $totalCommission = 0;

    //     $comms = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
    //         ->where('commissions.id', '=', $commission->id)
    //         ->get(['orders.*']);

    //     $rankings = User::select('ranking_id')
    //             ->where('id', $cust->created_by)
    //             ->first();

    //     // calculate commission based on ranking

    //     $comms = new Commission;
    //     $comms->point_value = $requestData['point_value'];
    //     $comms->percentage = $requestData['percentage'];
    //     $comms->first_month = $requestData['first_month'];
    //     $comms->save();

    //     // alert()->success(__('global.create_success'))->toToast();
    //     return redirect()->route('admin.commissions.show');
    // }

    public function edit(Commission $commission)
    {
        abort_if(Gate::denies('commission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('agent_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orders = Order::pluck('ref_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $commission->load('user', 'orders', 'team');

        return view('admin.commissions.edit', compact('commission', 'orders', 'users'));
    }

    public function update(UpdateCommissionRequest $request, Commission $commission)
    {
        $commission->update($request->all());

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.commissions.index');
    }

    public function show(Commission $commission)
    {
        abort_if(Gate::denies('commission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commission->load('user', 'orders', 'team');

        return view('admin.commissions.show', compact('commission'));
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

    public function withdrawCommission(Request $req, $id)
    {
        // get total commission by certain agent

        // deduct the total commission and save into debit_amount column
    }

    public function commissionCalculator(Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments');
        return view('admin.commissions.calculator', compact('order'));
    }

    public function commissionStore(Request $request, Order $order)
    {
        $requestData = $request->all();

        $newPV = isset($requestData['point_value']) ? $requestData['point_value'] : null;
        $totalCommission = $installmentPV = 0;

        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments');
        $rankings = isset($order->createdBy) ? $order->createdBy : '';
        $parent = isset($order->createdBy->parent_id) ? $order->createdBy->parent_id : '';
        $installmentMonths = isset($order->installments->installment_year) ? $order->installments->installment_year : '';

        // check method payment
        if ($order->customer->mode == 'Installment') {
            $installmentPV = ($newPV / $installmentMonths);

            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($installmentPV * 0.16), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 2:
                    $totalCommission += round(($installmentPV * 0.04), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 3:
                    $totalCommission += round(($installmentPV * 0.02), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 4:
                    $totalCommission += round(($installmentPV * 0.04),2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 5:
                    $totalCommission += round(($installmentPV * 0.05), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                default:
                    break;
            }
        } else {
            switch ($rankings->ranking_id) {
                case 1:
                    $totalCommission += round(($newPV * 0.16), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 2:
                    $totalCommission += round(($newPV * 0.04), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 3:
                    $totalCommission += round(($newPV * 0.02), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 4:
                    $totalCommission += round(($newPV * 0.04),2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                case 5:
                    $totalCommission += round(($newPV * 0.05), 2);
                    // $parentCommission = $this->getParent();
                    // $pp = $this->getPP();
                    break;
                default:
                    break;
            }
        }

        // save to commission tables
        $comms = new Commission;
        $comms->mo_overriding_comm = $totalCommission;
        $comms->point_value = $requestData['point_value'];
        $comms->percentage = $requestData['percentage'];
        $comms->first_month = $requestData['first_month'];
        $comms->order_id = $order->id;
        $comms->user_id = $order->createdBy->id;
        $comms->save();

        return view('admin.commissions.results', compact('order', 'comms'));
    }
}
