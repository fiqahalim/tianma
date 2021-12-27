<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use DB;

class MembersController extends Controller
{
    public function myTree()
    {
        $users = User::where('id', auth()->user()->id)
            ->whereNull('parent_id')
            ->with(['childUsers.childUsers'])
            ->get();

        return view('pages.downline.tree')->with([
            'users' => $users,
        ]);
    }

    public function myReferral(Order $order)
    {
        $totalProductAmount = 0;
        $point_value = (float)1.50;

        $orders = Order::select('amount')
            ->where('created_by', auth()->user()->id)
            ->get();

        foreach($orders as $keys => $values) {
            // get all amount by multiply with point value
            $totalProductAmount += $values['amount'] * $point_value;
        }

        // stored in order items table
        $order_items = null;
        $order_items = new OrderItem;
        $order_items->totalProductAmount = $totalProductAmount;
        $order_items->user_id = auth()->user()->id;
        $order_items->save();

        session(['totalProductAmount' => $totalProductAmount]);

        return view('pages.report.ref-commission')->with([
            'total' => $totalProductAmount,
        ]);
    }
}
