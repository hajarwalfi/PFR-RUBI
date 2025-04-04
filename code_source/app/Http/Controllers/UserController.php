<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * Constructor with UserService dependency injection
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
//        $this->middleware('admin');
    }

    /**
     * Display the list of users
     */
    public function index(Request $request)
    {
        // Get filters from the request
        $filters = [
            'search' => $request->input('search'),
            'eligibility' => $request->input('eligibility'),
            'per_page' => $request->input('per_page', 10)
        ];

        // Use the service to retrieve data
        $users = $this->userService->getAllUsers($filters);
        $statistics = $this->userService->getUsersStatistics();

        // Pass the service to the view to use its methods
        return view('Admin.Users.index', [
            'users' => $users,
            'statistics' => $statistics,
            'request' => $request,
            'userService' => $this->userService // Important to use service methods in the view
        ]);
    }

    /**
     * Display user details
     */
    public function show($id)
    {
        // Use the service to retrieve the user
        $user = $this->userService->getUserById($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'User not found');
        }

        // Pass the service to the view
        return view('Admin.Users.show', [
            'user' => $user,
            'userService' => $this->userService
        ]);
    }

    /**
     * Delete a user
     */
    public function destroy($id)
    {
        // Use the service to delete the user
        $result = $this->userService->deleteUser($id);

        // Redirect with a success or error message
        if ($result) {
            return redirect()->route('Admin.Users.index')
                ->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('Admin.Users.index')
                ->with('error', 'Error deleting user');
        }
    }

    /**
     * Display the form to create a new user
     */
    public function create()
    {
        return view('Admin.Users.create');
    }

    /**
     * Save a new user
     */
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

    /**
     * Display the form to edit a user
     */
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
            // Redirect to the user's medical record instead of the users list
            return redirect()->route('Users.show', $id)
                ->with('success', 'User updated successfully');
        } else {
            return redirect()->route('Admin.Users.edit', $id)
                ->with('error', 'Error updating user');
        }
    }
}
