<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\Commission;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Carbon\Carbon;
use Auth;

class MembersController extends Controller
{
    public function myTree(Request $request)
    {
        $users = Auth::user()->childUsers()->get();
        $parent = Auth::user()->parent()->get();
        $team = Auth::user()->team()->get();

        return view('pages.downline.tree')->with([
            'users' => $users,
            'parent' => $parent,
            'team' => $team,
        ]);
    }

    public function myDownline(Request $request)
    {
        $users = Auth::user()->childUsers()->get();

        return view('pages.downline.downline', compact('users'));
    }

    public function myCommission(Order $order)
    {
        $totalMonthlyCommission = 0;
        $data = [];

        $totalOrders = Order::where([
                ['created_by', auth()->user()->id],
                ['approved', '=', 1]
            ])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $rankings = User::select('ranking_id')
            ->where('id', auth()->user()->id)
            ->first();

        // calculate monthly commission based on ranking
        // for ($year = 2021; $year <= now()->format('Y') ; $year++) {
        //     for ($month = 1; $month <= 12; $month++) {

                // $date = Carbon::create(date('Y'), $month);
                // $date_end = $date->copy()->endOfMonth();

                // $totalOrders = Order::where('created_by', auth()->user()->id)
                //         ->where('created_at', '>=', $date)
                //         ->where('created_at', '<=', $date_end)
                //         ->sum('amount');

                switch ($rankings->ranking_id) {
                    case 1:
                        $totalMonthlyCommission += round(($totalOrders * 0.16), 2);
                        break;
                    case 2:
                        $totalMonthlyCommission += $totalOrders * 0.04;
                        break;
                    case 3:
                        $totalMonthlyCommission += $totalOrders * 0.02;
                        break;
                    case 4:
                        $totalMonthlyCommission += $totalOrders * 0.04;
                        break;
                    case 5:
                        $totalMonthlyCommission += $totalOrders * 0.05;
                        break;
                    default:
                        break;
                }
        //     }
        // }

        /**
         * Stored in commission tables only when order was approved
         **/
        $commissions = null;
        $commissions = new Commission;
        $commissions->mo_overriding_comm = $totalMonthlyCommission;
        $commissions->created_at = $current = Carbon::now('+08:00');
        $commissions->user_id = auth()->user()->id;
        $commissions->order_id = $order->id;
        // $commissions->team_id = $team->id;
        $commissions->save();

        return view('pages.report.ref-commission')->with([
            'totalOrders' => $totalOrders,
            'commissionMonthly' => $totalMonthlyCommission,
        ]);
    }
}
