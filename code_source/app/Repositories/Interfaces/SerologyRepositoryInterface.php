<?php

namespace App\Repositories\Interfaces;

use App\Models\Serology;
use Illuminate\Database\Eloquent\Collection;

interface SerologyRepositoryInterface
{
    public function getSerologyById(int $id): ?Serology;
    public function getSerologyByDonationId(int $donationId): ?Serology;
    public function createSerology(array $data): Serology;
    public function updateSerology(int $id, array $data): bool;
    public function deleteSerology(int $id): bool;
}
