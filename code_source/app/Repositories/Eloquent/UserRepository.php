<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{

    public function getAllUsers(array $filters = [])
    {
        $query = User::query();

        if (isset($filters['search']) && !empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'ilike', "%{$search}%")
                    ->orWhere('last_name', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%")
                    ->orWhere('phone', 'ilike', "%{$search}%")
                    ->orWhere('blood_group', 'ilike', "%{$search}%");
            });
        }

        if (isset($filters['eligibility'])) {
            if ($filters['eligibility'] === 'eligible') {
                $query->whereDoesntHave('donations.serology', function($q) {
                    $q->where('result', 'positive');
                })->where(function($q) {
                    $q->doesntHave('donations')
                        ->orWhereHas('donations', function($q2) {
                            $threeMonthsAgo = Carbon::now()->subMonths(3);
                            $q2->where('date', '<', $threeMonthsAgo)
                                ->orderBy('date', 'desc')
                                ->limit(1);
                        });
                });
            } elseif ($filters['eligibility'] === 'ineligible') {
                $query->where(function($q) {
                    $q->whereHas('donations.serology', function($q2) {
                        $q2->where('result', 'positive');
                    })
                        ->orWhereHas('donations', function($q2) {
                            $threeMonthsAgo = Carbon::now()->subMonths(3);
                            $q2->where('date', '>=', $threeMonthsAgo)
                                ->orderBy('date', 'desc')
                                ->limit(1);
                        });
                });
            }
        }

        $perPage = $filters['per_page'] ?? 10;

        $query->with('donations.serology');

        return $query->paginate($perPage);
    }


    public function getUsersCount()
    {
        return User::count();
    }


    public function getEligibleUsersCount()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        return User::whereDoesntHave('donations.serology', function($query) {
            $query->where('result', 'positive');
        })->where(function($query) use ($threeMonthsAgo) {
            $query->doesntHave('donations')
                ->orWhereHas('donations', function($q) use ($threeMonthsAgo) {
                    $q->where('date', '<', $threeMonthsAgo)
                        ->orderBy('date', 'desc')
                        ->limit(1);
                });
        })->count();
    }

    public function getIneligibleUsersCount()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        return User::where(function($query) use ($threeMonthsAgo) {

            $query->whereHas('donations.serology', function($q) {
                $q->where('result', 'positive');
            })
                ->orWhereHas('donations', function($q) use ($threeMonthsAgo) {
                    $q->where('date', '>=', $threeMonthsAgo)
                        ->orderBy('date', 'desc')
                        ->limit(1);
                });
        })->count();
    }


    public function getUnconfirmedUsersCount()
    {
        return User::whereNull('cni')->count();
    }

    public function getUsersByEligibility($eligible = true)
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $query = User::query();

        if ($eligible) {

            $query->whereDoesntHave('donations.serology', function($q) {
                $q->where('result', 'positive');
            })->where(function($q) use ($threeMonthsAgo) {
                $q->doesntHave('donations')

                    ->orWhereHas('donations', function($q2) use ($threeMonthsAgo) {
                        $q2->where('date', '<', $threeMonthsAgo)
                            ->orderBy('date', 'desc')
                            ->limit(1);
                    });
            });
        } else {
            $query->where(function($q) use ($threeMonthsAgo) {
                $q->whereHas('donations.serology', function($q2) {
                    $q2->where('result', 'positive');
                })
                    ->orWhereHas('donations', function($q2) use ($threeMonthsAgo) {
                        $q2->where('date', '>=', $threeMonthsAgo)
                            ->orderBy('date', 'desc')
                            ->limit(1);
                    });
            });
        }

        return $query->get();
    }

    public function getUserById($id)
    {
        return User::with(['donations' => function($query) {
            $query->orderBy('date', 'desc');
        }, 'donations.serology'])->findOrFail($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }

    public function getLatestUserIdentifier(): ?string
    {
        return User::where('identifier', 'like', 'DNR%')
            ->orderBy('identifier', 'desc')
            ->value('identifier');
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }
}
