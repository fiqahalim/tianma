<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use Alert;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        alert()->success(__('global.change_password_success'))->toToast();
        return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    }

    // Update Profile
    public function profile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->address_1 = $request->input('address_1');
        $user->address_2 = $request->input('address_2');
        $user->state = $request->input('state');
        $user->postcode = $request->input('postcode');
        $user->city = $request->input('city');
        $user->save();

        alert()->success(__('global.update_profile_success'))->toToast();
        return redirect()->route('profile.index');
    }

    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'avatar' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $profileImage = time() . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('images/profile'), $profileImage);

        $user->avatar = $profileImage;
        $user->save();
        
        alert()->success(__('global.update_profile_image_success'))->toToast();
        return redirect()->route('profile.index');
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        alert()->success(__('global.delete_account_success'))->toToast();
        return redirect()->route('login');
    }
}
