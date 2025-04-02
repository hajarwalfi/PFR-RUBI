<?php

namespace App\Repositories\Interfaces;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface DonationRepositoryInterface
{
    public function getAllDonations(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function getDonationById(int $id): ?Donation;
    public function getDonationsByUserId(int $userId): Collection;
    public function createDonation(array $data): Donation;
    public function updateDonation(int $id, array $data): bool;
    public function deleteDonation(int $id): bool;
    public function getLatestDonations(int $limit = 5): Collection;
    public function getDonationWithRelations(int $id, array $relations = []): ?Donation;
}
