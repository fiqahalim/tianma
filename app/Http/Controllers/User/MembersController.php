<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Ranking;
use App\Models\Commission;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use DB;
use Auth;

class MembersController extends Controller
{
    public function index()
    {
        $users = Auth::user()->childUsers()->get();

        return view('pages.downline.downline', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('title', 'id');

        $rankings = Ranking::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::whereNull('parent_id')
            ->with('childUsers')
            ->get();

        return view('pages.downline.create', compact('roles', 'teams', 'users', 'rankings'));
    }

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

    public function myCommission(Order $order)
    {
        return view('pages.report.ref-commission');
    }
}
