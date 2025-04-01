<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(array $filters = [])
    {
        $query = User::query();

        // Apply search filter
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Apply eligibility filter
        if (isset($filters['eligibility'])) {
            if ($filters['eligibility'] === 'eligible') {
                $query->whereDoesntHave('donations.serology', function($q) {
                    $q->where('result', 'positive');
                });
            } elseif ($filters['eligibility'] === 'ineligible') {
                $query->whereHas('donations.serology', function($q) {
                    $q->where('result', 'positive');
                });
            }
        }

        // Apply pagination
        $perPage = $filters['per_page'] ?? 10;

        return $query->paginate($perPage);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->getUserById($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }

    public function getUsersCount()
    {
        return User::count();
    }

    public function getEligibleUsersCount()
    {
        // Users who don't have any positive serology results
        $ineligibleCount = $this->getIneligibleUsersCount();
        $totalCount = $this->getUsersCount();

        return $totalCount - $ineligibleCount;
    }

    public function getIneligibleUsersCount()
    {
        // Users who have at least one positive serology result
        return User::whereHas('donations.serology', function($query) {
            $query->where('result', 'positive');
        })->distinct()->count();
    }

    public function getUnconfirmedUsersCount()
    {
        // Users who haven't verified their email
        return User::whereNull('email_verified_at')->count();
    }

    public function getUsersByEligibility($eligible = true)
    {
        $query = User::query();

        if ($eligible) {
            $query->whereDoesntHave('donations.serology', function($q) {
                $q->where('result', 'positive');
            });
        } else {
            $query->whereHas('donations.serology', function($q) {
                $q->where('result', 'positive');
            });
        }

        return $query->get();
    }
}
