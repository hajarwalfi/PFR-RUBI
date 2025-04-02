<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * Constructeur avec injection de dépendance
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Récupère tous les utilisateurs avec filtres
     * Délègue au repository
     */
    public function getAllUsers(array $filters = [])
    {
        return $this->userRepository->getAllUsers($filters);
    }

    /**
     * Récupère toutes les statistiques des utilisateurs en une seule méthode
     * Agrège plusieurs appels au repository
     */
    public function getUsersStatistics(): array
    {
        // Logique métier: regrouper les statistiques en un seul objet
        $total = $this->userRepository->getUsersCount();
        $eligible = $this->userRepository->getEligibleUsersCount();
        $ineligible = $this->userRepository->getIneligibleUsersCount();
        $unconfirmed = $this->userRepository->getUnconfirmedUsersCount();

        // Calcul des pourcentages
        $eligiblePercent = $total > 0 ? round(($eligible / $total) * 100) : 0;
        $ineligiblePercent = $total > 0 ? round(($ineligible / $total) * 100) : 0;

        return [
            'total' => $total,
            'eligible' => $eligible,
            'eligible_percent' => $eligiblePercent,
            'ineligible' => $ineligible,
            'ineligible_percent' => $ineligiblePercent,
            'unconfirmed' => $unconfirmed,
        ];
    }

    /**
     * Récupère un utilisateur par son ID
     * Délègue au repository
     */
    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    /**
     * Supprime un utilisateur
     * Délègue au repository
     */
    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    /**
     * Détermine le statut d'un utilisateur (Nouveau, Occasionnel, Régulier)
     * Logique métier pure
     */
    public function determineUserStatus($user)
    {
        $donationCount = $user->donations->count();

        if ($donationCount > 3) {
            return [
                'status' => 'Régulier',
                'class' => 'bg-blue-50 text-blue-700'
            ];
        } elseif ($donationCount > 0) {
            return [
                'status' => 'Occasionnel',
                'class' => 'bg-amber-50 text-amber-700'
            ];
        } else {
            return [
                'status' => 'Nouveau',
                'class' => 'bg-green-50 text-green-700'
            ];
        }
    }

    /**
     * Vérifie si un utilisateur est éligible pour donner du sang
     * Logique métier pure
     */
    public function isUserEligible($user)
    {
        // Vérifier si l'utilisateur a des résultats sérologiques positifs
        foreach ($user->donations as $donation) {
            if ($donation->serology && $donation->serology->result === 'positive') {
                return false;
            }
        }

        // Vérifier la date du dernier don (doit être > 3 mois)
        if ($user->donations->isNotEmpty()) {
            $lastDonation = $user->donations->sortByDesc('date')->first();
            $threeMonthsAgo = Carbon::now()->subMonths(3);

            if ($lastDonation->date->greaterThanOrEqualTo($threeMonthsAgo)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Vérifie si un utilisateur est confirmé (a un CNI)
     * Logique métier pure
     */
    public function isUserConfirmed($user)
    {
        return !empty($user->cni);
    }

    /**
     * Calcule la date du prochain don possible
     * Logique métier pure
     */
    public function getNextDonationDate($user)
    {
        if ($user->donations->isEmpty()) {
            return null;
        }

        $lastDonation = $user->donations->sortByDesc('date')->first();
        return $lastDonation->date->copy()->addMonths(3);
    }

    /**
     * Vérifie si tous les tests sérologiques sont négatifs
     * Logique métier pure
     */
    public function hasNegativeSerologyResults($user)
    {
        foreach ($user->donations as $donation) {
            if ($donation->serology) {
                // Si un seul des tests est positif, le résultat global est positif
                if ($donation->serology->tpha === 'positive' ||
                    $donation->serology->hb === 'positive' ||
                    $donation->serology->hc === 'positive' ||
                    $donation->serology->vih === 'positive') {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Crée un nouvel utilisateur
     * Logique métier: hachage du mot de passe, génération d'identifiant, etc.
     */
    public function createUser(array $data)
    {
        // Générer un identifiant unique pour l'utilisateur
        $data['identifier'] = $this->generateUniqueIdentifier();

        // Hacher le mot de passe
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Déléguer la création au repository
        return $this->userRepository->createUser($data);
    }

    /**
     * Met à jour un utilisateur existant
     * Logique métier: vérification des données, mise à jour conditionnelle, etc.
     */
    public function updateUser($id, array $data)
    {
        // Hacher le mot de passe si présent
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Ne pas mettre à jour le mot de passe s'il est vide
            unset($data['password']);
        }

        // Déléguer la mise à jour au repository
        return $this->userRepository->updateUser($id, $data);
    }

    /**
     * Génère un identifiant unique pour un utilisateur
     * Logique métier pure
     */
    private function generateUniqueIdentifier()
    {
        // Préfixe + année + mois + 4 chiffres aléatoires
        $prefix = 'USR';
        $date = Carbon::now()->format('ym');
        $random = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        return $prefix . $date . $random;
    }


}
