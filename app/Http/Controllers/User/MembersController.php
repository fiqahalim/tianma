<?php

namespace App\Http\Controllers\User;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreUserRequest;
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
        // $rankings = Ranking::get();
        // dd($rankings);

        $users = User::whereNull('parent_id')
            ->with('childUsers')
            ->get();

        return view('pages.downline.create', compact('roles', 'users'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('user.my-downline.index');
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
