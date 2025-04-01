<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(array $filters = [])
    {
        return $this->userRepository->getAllUsers($filters);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser(array $data)
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Generate identifier if not provided
        if (!isset($data['identifier'])) {
            $data['identifier'] = $this->generateUniqueIdentifier();
        }

        return $this->userRepository->createUser($data);
    }

    public function updateUser($id, array $data)
    {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

    public function getUsersStatistics()
    {
        return [
            'total' => $this->userRepository->getUsersCount(),
            'eligible' => $this->userRepository->getEligibleUsersCount(),
            'ineligible' => $this->userRepository->getIneligibleUsersCount(),
            'unconfirmed' => $this->userRepository->getUnconfirmedUsersCount(),
        ];
    }

    public function getUsersByEligibility($eligible = true)
    {
        return $this->userRepository->getUsersByEligibility($eligible);
    }

    protected function generateUniqueIdentifier()
    {
        // Generate a unique identifier for the user
        $prefix = 'USR';
        $randomPart = strtoupper(substr(uniqid(), -6));
        return $prefix . '-' . $randomPart;
    }
}
