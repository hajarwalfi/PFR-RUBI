<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
//        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('search'),
            'eligibility' => $request->input('eligibility'),
            'per_page' => $request->input('per_page', 10)
        ];

        $users = $this->userService->getAllUsers($filters);
        $statistics = $this->userService->getUsersStatistics();

        return view('Admin.Users.index', [
            'users' => $users,
            'statistics' => $statistics,
            'request' => $request,
            'userService' => $this->userService // Important to use service methods in the view
        ]);
    }
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'User not found');
        }

        return view('Admin.Users.show', [
            'user' => $user,
            'userService' => $this->userService
        ]);
    }

    public function destroy($id)
    {
        $result = $this->userService->deleteUser($id);

        if ($result) {
            return redirect()->route('Admin.Users.index')
                ->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'Error deleting user');
        }
    }

    public function create()
    {
        return view('Admin.Users.create');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string',
            'cni' => 'nullable|string|unique:users,cni',
            'birth_date' => 'nullable|date',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'nullable|in:male,female',
        ]);

        // Use the service to create the user
        $user = $this->userService->createUser($validated);

        return redirect()->route('Admin.Users.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'User not found');
        }

        return view('Admin.Users.editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'nullable|string',
            'cni' => 'nullable|string|unique:users,cni,'.$id,
            'birth_date' => 'nullable|date',
            'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'gender' => 'nullable|in:male,female',
        ]);

        // Use the service to update the user
        $result = $this->userService->updateUser($id, $validated);

        if ($result) {
            return redirect()->route('Users.show', $id)
                ->with('success', 'User updated successfully');
        } else {
            return redirect()->route('Admin.Users.edit', $id)
                ->with('error', 'Error updating user');
        }
    }
}
