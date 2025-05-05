<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(array $filters = [])
    {
        return $this->userRepository->getAllUsers($filters);
    }

    public function getUsersStatistics(): array
    {
        $total = $this->userRepository->getUsersCount();
        $eligible = $this->userRepository->getEligibleUsersCount();
        $ineligible = $this->userRepository->getIneligibleUsersCount();
        $unconfirmed = $this->userRepository->getUnconfirmedUsersCount();
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

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function determineUserStatus($user)
    {
        $donationCount = $user->donations->count();

        if ($donationCount > 3) {
            return [
                'status' => 'Regular',
                'class' => 'bg-blue-50 text-blue-700'
            ];
        } elseif ($donationCount > 0) {
            return [
                'status' => 'Occasional',
                'class' => 'bg-amber-50 text-amber-700'
            ];
        } else {
            return [
                'status' => 'New',
                'class' => 'bg-green-50 text-green-700'
            ];
        }
    }

    public function isUserEligible($user)
    {
        foreach ($user->donations as $donation) {
            if ($donation->serology && $donation->serology->result === 'positive') {
                return false;
            }
        }

        if ($user->donations->isNotEmpty()) {
            $lastDonation = $user->donations->sortByDesc('date')->first();
            $threeMonthsAgo = Carbon::now()->subMonths(3);

            if ($lastDonation->date->greaterThanOrEqualTo($threeMonthsAgo)) {
                return false;
            }
        }

        return true;
    }

    public function isUserConfirmed($user)
    {
        return !empty($user->cni);
    }


    public function getNextDonationDate($user)
    {
        if ($user->donations->isEmpty()) {
            return null;
        }

        $lastDonation = $user->donations->sortByDesc('date')->first();
        return $lastDonation->date->copy()->addMonths(3);
    }

    public function hasNegativeSerologyResults($user)
    {
        foreach ($user->donations as $donation) {
            if ($donation->serology) {
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

    public function registerUser(array $userData)
    {

        $userData['identifier'] = $this->generateSequentialIdentifier();

        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }
        $user = $this->userRepository->createUser($userData);

        $user->roles()->attach(2);
        return $user;
    }

    private function generateSequentialIdentifier(): string
    {
        $latestIdentifier = $this->userRepository->getLatestUserIdentifier();

        if (!$latestIdentifier) {
            return 'DNR001';
        }


        $numericPart = (int) substr($latestIdentifier, 3);

        $nextNumeric = $numericPart + 1;

        return 'DNR' . str_pad($nextNumeric, 3, '0', STR_PAD_LEFT);
    }

    public function createUser(array $data)
    {

        if (!isset($data['identifier'])) {
            $data['identifier'] = $this->generateSequentialIdentifier();
        }

        if (isset($data['use_sequential_id'])) {
            unset($data['use_sequential_id']);
        }

        // Hacher le mot de passe
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->createUser($data);
    }


    public function updateUser($id, array $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->updateUser($id, $data);
    }
    public function updatePersonalInfo($userId, array $data)
    {
        return $this->userRepository->update($userId, [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'blood_group' => $data['blood_group'] ?? null,
            'gender' => $data['gender'] ?? null,
            'address' => $data['address'] ?? null,
        ]);
    }

    public function updateAccountSettings($userId, array $data)
    {
        return $this->userRepository->update($userId, [
            'email' => $data['email'],
        ]);
    }


    public function updatePassword($userId, $password)
    {
        return $this->userRepository->update($userId, [
            'password' => Hash::make($password),
        ]);
    }


}
