<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function createUser(array $userData): User
    {
        return User::create($userData);
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function assignRole(User $user, string $role): void
    {
        $roleModel = Role::where('name', $role)->first();

        if ($roleModel && !$user->hasRole($role)) {
            $user->roles()->attach($roleModel->id);
        }
    }
}
