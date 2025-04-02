<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Récupère tous les utilisateurs avec filtres et pagination
     */
    public function getAllUsers(array $filters = [])
    {
        $query = User::query();

        // Appliquer le filtre de recherche
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

        // Appliquer le filtre d'éligibilité
        if (isset($filters['eligibility'])) {
            if ($filters['eligibility'] === 'eligible') {
                // Utilisateurs éligibles: tous les tests négatifs et dernier don > 3 mois
                $query->whereDoesntHave('donations.serology', function($q) {
                    $q->where('result', 'positive');
                })->where(function($q) {
                    // Soit aucun don précédent
                    $q->doesntHave('donations')
                        // Soit dernier don > 3 mois
                        ->orWhereHas('donations', function($q2) {
                            $threeMonthsAgo = Carbon::now()->subMonths(3);
                            $q2->where('date', '<', $threeMonthsAgo)
                                ->orderBy('date', 'desc')
                                ->limit(1);
                        });
                });
            } elseif ($filters['eligibility'] === 'ineligible') {
                // Utilisateurs inéligibles: tests positifs OU dernier don < 3 mois
                $query->where(function($q) {
                    // Soit au moins un test positif
                    $q->whereHas('donations.serology', function($q2) {
                        $q2->where('result', 'positive');
                    })
                        // Soit dernier don < 3 mois
                        ->orWhereHas('donations', function($q2) {
                            $threeMonthsAgo = Carbon::now()->subMonths(3);
                            $q2->where('date', '>=', $threeMonthsAgo)
                                ->orderBy('date', 'desc')
                                ->limit(1);
                        });
                });
            }
        }

        // Appliquer la pagination
        $perPage = $filters['per_page'] ?? 10;

        // Charger les relations nécessaires
        $query->with('donations.serology');

        return $query->paginate($perPage);
    }

    /**
     * Compte le nombre total d'utilisateurs
     */
    public function getUsersCount()
    {
        return User::count();
    }

    /**
     * Compte le nombre d'utilisateurs éligibles
     * (tous les tests négatifs ET dernier don > 3 mois)
     */
    public function getEligibleUsersCount()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        return User::whereDoesntHave('donations.serology', function($query) {
            $query->where('result', 'positive');
        })->where(function($query) use ($threeMonthsAgo) {
            // Soit aucun don précédent
            $query->doesntHave('donations')
                // Soit dernier don > 3 mois
                ->orWhereHas('donations', function($q) use ($threeMonthsAgo) {
                    $q->where('date', '<', $threeMonthsAgo)
                        ->orderBy('date', 'desc')
                        ->limit(1);
                });
        })->count();
    }

    /**
     * Compte le nombre d'utilisateurs inéligibles
     * (au moins un test positif OU dernier don < 3 mois)
     */
    public function getIneligibleUsersCount()
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        return User::where(function($query) use ($threeMonthsAgo) {
            // Soit au moins un test positif
            $query->whereHas('donations.serology', function($q) {
                $q->where('result', 'positive');
            })
                // Soit dernier don < 3 mois
                ->orWhereHas('donations', function($q) use ($threeMonthsAgo) {
                    $q->where('date', '>=', $threeMonthsAgo)
                        ->orderBy('date', 'desc')
                        ->limit(1);
                });
        })->count();
    }

    /**
     * Compte le nombre d'utilisateurs non confirmés (CNI vide)
     */
    public function getUnconfirmedUsersCount()
    {
        return User::whereNull('cni')->count();
    }

    /**
     * Récupère les utilisateurs filtrés par éligibilité
     */
    public function getUsersByEligibility($eligible = true)
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $query = User::query();

        if ($eligible) {
            // Utilisateurs éligibles: tous les tests négatifs et dernier don > 3 mois
            $query->whereDoesntHave('donations.serology', function($q) {
                $q->where('result', 'positive');
            })->where(function($q) use ($threeMonthsAgo) {
                // Soit aucun don précédent
                $q->doesntHave('donations')
                    // Soit dernier don > 3 mois
                    ->orWhereHas('donations', function($q2) use ($threeMonthsAgo) {
                        $q2->where('date', '<', $threeMonthsAgo)
                            ->orderBy('date', 'desc')
                            ->limit(1);
                    });
            });
        } else {
            // Utilisateurs inéligibles: tests positifs OU dernier don < 3 mois
            $query->where(function($q) use ($threeMonthsAgo) {
                // Soit au moins un test positif
                $q->whereHas('donations.serology', function($q2) {
                    $q2->where('result', 'positive');
                })
                    // Soit dernier don < 3 mois
                    ->orWhereHas('donations', function($q2) use ($threeMonthsAgo) {
                        $q2->where('date', '>=', $threeMonthsAgo)
                            ->orderBy('date', 'desc')
                            ->limit(1);
                    });
            });
        }

        return $query->get();
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function getUserById($id)
    {
        return User::with(['donations' => function($query) {
            $query->orderBy('date', 'desc');
        }, 'donations.serology'])->findOrFail($id);
    }

    /**
     * Supprime un utilisateur par son ID
     */
    public function deleteUser($id)
    {
        return User::destroy($id);
    }

    /**
     * Crée un nouvel utilisateur
     */
    public function createUser(array $data)
    {
        return User::create($data);
    }

    /**
     * Met à jour un utilisateur existant
     */
    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }
}
