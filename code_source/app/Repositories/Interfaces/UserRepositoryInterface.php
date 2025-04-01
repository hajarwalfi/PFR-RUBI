<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    // ----------------------users.blade.php page------------------------//
    //-------------------------------------------------------------------//
    // For the main table of users with pagination and search
    public function getAllUsers(array $filters = []);

    // For the stats cards
    public function getUsersCount();
    public function getEligibleUsersCount();
    public function getIneligibleUsersCount();
    public function getUnconfirmedUsersCount();

    // For filter buttons
    public function getUsersByEligibility($eligible = true);

    // For individual user operations (view/delete from dropdown)
    public function getUserById($id);
    public function deleteUser($id);
    //-----------------------------------------------------------------------//
}
