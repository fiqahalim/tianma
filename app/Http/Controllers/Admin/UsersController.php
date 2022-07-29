<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\Ranking;
use App\Models\Order;
use App\Models\Commission;
use Gate;
use Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

use App\Notifications\UserApprovedNotification;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles', 'team', 'parent', 'commissions', 'rankings'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $rankings = Ranking::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::whereNull('parent_id')
            ->with('childUsers')
            ->get();

        return view('admin.users.create', compact('roles', 'teams', 'users', 'rankings'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        alert()->success(__('global.create_success'))->toToast();
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $rankings = Ranking::pluck('category', 'id');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parentUser = User::whereNull('parent_id')
            ->with('childUsers')
            ->get();

        $totalComms = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->where('commissions.user_id', $user->id)
            ->where('orders.approved', '=', 1)
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->get(['commissions.mo_overriding_comm', 'orders.amount']);

        $user->load('roles', 'parent', 'team', 'rankings');

        return view('admin.users.edit', compact('roles', 'teams', 'parentUser', 'user', 'rankings', 'totalComms'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $approved = $user->approved;
        $folder = 'avatars';

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if ($approved == 0 && $user->approved == 1) {
            $user->notify(new UserApprovedNotification());
        }

        if($user->avatar == null) {
            $request->validate([
                'avatar' => 'required|mimes:jpg,png,jpeg|max:5048'
            ]);

            $profileImage = time().'.'.$user->avatar->extension();
            $user->avatar->move(public_path('images/profile'), $profileImage);

            $user->avatar = $profileImage;
            $user->save();
        }

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.users.index');
    }

    public function show(Request $request, User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'team', 'parent', 'userUserAlerts', 'childUsers', 'commissions', 'rankings');

        $keyword = $request->search;

        $totas = '';

        $totalComms = Order::where('orders.created_by', $user->id)
            ->sum('orders.amount');

        foreach($user->childUsers as $childUser) {
            $totas = Order::where('orders.created_by', $childUser->id)
                ->sum('orders.amount');
        }

        $getUsers = User::where('agent_code', 'like', '%' . $request->search . '%')
            ->get()
            ->map(function ($row) use ($keyword) {
                $row->agent_code = preg_replace('/(' . $keyword . ')/i', "<span class='highlight'>$1</span>", $row->agent_code);
                return $row;
            });

        return view('admin.users.show', compact('user', 'totalComms', 'totas', 'getUsers'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        alert()->success(__('global.delete_success'))->toToast();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function agentCommissions(Request $request, User $user)
    {
        $user->load('parent', 'childUsers', 'commissions', 'rankings', 'orders');

        $myOrders = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('product_bookings', 'product_bookings.id', '=', 'orders.product_bookings_id')
            ->where('orders.created_by', $user->id)
            ->where('orders.approved', '=', 1)
            ->whereMonth('orders.created_at', Carbon::now()->month)
            ->whereYear('orders.created_at', Carbon::now()->year)
            ->get(['orders.*', 'product_bookings.*', 'customers.full_name', 'customers.id_number']);

        $myComms = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->join('installments', 'installments.id', '=', 'orders.id')
            ->join('product_bookings', 'product_bookings.id', '=', 'orders.product_bookings_id')
            ->join('users', 'users.id', '=', 'orders.created_by')
            ->where('commissions.user_id', $user->id)
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->get(['commissions.*', 'orders.*', 'installments.*', 'product_bookings.*', 'users.ranking_id']);

        return view('admin.users.agentCommissions', compact('user', 'myOrders', 'myComms'));
    }

    public function commissionStatement(Request $request, Order $order)
    {
        $order->load('customer', 'team', 'createdBy', 'commissions', 'installments', 'products', 'lotID');

        $myComms = Order::join('commissions', 'commissions.order_id', '=', 'orders.id')
            ->join('users', 'users.id', '=', 'orders.created_by')
            ->join('product_bookings', 'product_bookings.id', '=', 'orders.product_bookings_id')
            ->where('commissions.order_id', $order->id)
            ->get(['commissions.*', 'users.ranking_id', 'product_bookings.*']);

        $allCommissions = Commission::with(['user', 'orders'])->where('order_id', $order->id)->get();

        $firstPayout = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->where('commissions.order_id', $order->id)
            ->first();

        return view('admin.users.commissionStatement', compact('order', 'firstPayout', 'myComms', 'allCommissions'));
    }
}
