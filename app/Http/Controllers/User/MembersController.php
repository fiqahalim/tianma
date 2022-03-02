<?php

namespace App\Http\Controllers\User;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Ranking;
use App\Models\Commission;
use App\Models\Customer;
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

        $users = User::whereNull('parent_id')
            ->with('childUsers')
            ->get();

        return view('pages.downline.create', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'id_number' => 'required|unique:users',
            'email' => 'required|unique:users',
            'username' => 'required',
            'password' => 'required',
            'contact_no' => 'required',
            'agent_code' => 'required',
        ]);

        $user = null;
        $user = new User;
        $user->name = $request->name;
        $user->id_type = $request->id_type;
        $user->id_number = $request->id_number;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->contact_no = $request->contact_no;
        $user->agent_code = $request->agent_code;
        $user->parent_id = auth()->user()->id;
        $user->ranking_id = 1;
        $user->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('user.my-downline.index');
    }

    public function myTree(Request $request)
    {
        $user = Auth::user()->childUsers()->get();

        $parent = Auth::user()->parent()->get();

        return view('pages.downline.tree')->with([
            'user' => $user,
            'parent' => $parent,
        ]);
    }

    public function myCommission(Order $order)
    {
        $commissions = Commission::where('user_id', '=', Auth::user()->id)
            ->with(['user', 'orders', 'team', 'installments'])
            ->get();
        return view('pages.report.ref-commission', compact('commissions'));
    }

    public function myCustomers()
    {
        $customers = Customer::where('id', '=', Auth::user()->id)
            ->get();
        return view('pages.report.my-customer', compact('customers'));
    }
}
