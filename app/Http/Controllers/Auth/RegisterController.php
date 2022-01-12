<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Notifications\AdminNewUserNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        if (request()->has('signature') && !request()->hasValidSignature()) {
            return redirect()->route('register');
        }

        $users = User::where('parent_id')
            ->with('childUsers')
            ->get();

        return view('auth.register', compact('users'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'id_number'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'      => ['required', 'string', 'max:255'],
            'contact_no'    => ['required', 'string', 'max:255'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'          => $data['name'],
            'id_type'       => $data['id_type'],
            'id_number'     => $data['id_number'],
            'email'         => $data['email'],
            'username'      => $data['username'],
            'contact_no'    => $data['contact_no'],
            'password'      => Hash::make($data['password']),
            // 'team_id'       => request()->input('team', null),
            'parent_id'     => $data['parent_id'],
        ]);

        // send notification of new agent registered
        $administrators = User::whereHas('roles', function($q) {
            $q->where('title', 'Admin');
        })->get();

        foreach ($administrators as $admin) {
            $admin->notify(new AdminNewUserNotification($user));
        }

        // if (!request()->has('team')) {
        //     $team = \App\Models\Team::create([
        //         'owner_id' => $user->id,
        //         'name'     => $data['email'],
        //     ]);

        //     $user->update(['team_id' => $team->id]);
        // }

        return $user;
    }
}
