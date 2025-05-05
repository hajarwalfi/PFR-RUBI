<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers(array $filters = []);

    public function getUsersCount();
    public function getEligibleUsersCount();
    public function getIneligibleUsersCount();
    public function getUnconfirmedUsersCount();

    public function getUsersByEligibility($eligible = true);

    public function getUserById($id);

    public function createUser(array $data);
    public function updateUser($id, array $data);

    public function getLatestUserIdentifier(): ?string;
}
