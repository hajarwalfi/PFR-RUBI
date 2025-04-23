<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data): User
    {
        // Generate a unique identifier
        $data['identifier'] = $this->generateUniqueIdentifier();

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create the user
        $user = $this->authRepository->createUser($data);

        // Assign the donor role by default
        $this->authRepository->assignRole($user, 'donor');

        return $user;
    }

    public function login(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    private function generateUniqueIdentifier(): string
    {
        $prefix = 'USR';
        $date = Carbon::now()->format('ym');
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        return $prefix . $date . $random;
    }
}
