<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function createUser(array $userData): User;
    public function findUserByEmail(string $email): ?User;
    public function assignRole(User $user, string $role): void;
}
