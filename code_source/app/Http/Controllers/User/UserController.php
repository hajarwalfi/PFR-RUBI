<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        return view('User.Dashboard.profile', compact('user'));
    }

    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'address' => ['nullable', 'string', 'max:500'],
            'cni' => ['nullable', 'string', 'max:255'],
        ]);


        $this->userService->updatePersonalInfo(Auth::id(), $request->all());

        return redirect()->route('dashboard.profile')->with('success', 'Personal information updated successfully.');
    }

    public function updateAccountSettings(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $this->userService->updateAccountSettings(Auth::id(), $request->all());

        return redirect()->route('dashboard.profile')->with('success', 'Account settings updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $this->userService->updatePassword(Auth::id(), $request->password);

        return redirect()->route('dashboard.profile')->with('success', 'Password updated successfully.');
    }
}
