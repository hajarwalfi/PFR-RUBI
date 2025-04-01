<?php

namespace App\Repositories\Interfaces;

interface DonationRepositoryInterface
{
    public function getAllDonations(array $filters = []);
    public function getDonationById($id);
    public function createDonation(array $data);
    public function updateDonation($id, array $data);
    public function deleteDonation($id);
    public function getDonationsByUserId($userId);
}
