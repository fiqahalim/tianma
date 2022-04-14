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
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->sum('commissions.mo_overriding_comm');

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

        $request->validate([
            'avatar' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $profileImage = time().'.'.$user->avatar->extension();
        $user->avatar->move(public_path('images/profile'), $profileImage);

        $user->avatar = $profileImage;
        $user->save();

        alert()->success(__('global.update_success'))->toToast();
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'team', 'parent', 'userUserAlerts', 'childUsers', 'commissions', 'rankings');

        $totalComms = Commission::join('orders', 'orders.id', '=', 'commissions.order_id')
            ->where('commissions.user_id', $user->id)
            ->whereMonth('commissions.created_at', Carbon::now()->month)
            ->whereYear('commissions.created_at', Carbon::now()->year)
            ->sum('commissions.mo_overriding_comm');

        return view('admin.users.show', compact('user', 'totalComms'));
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
}
