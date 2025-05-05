<?php

namespace App\Repositories\Interfaces;

use App\Models\Observation;
use Illuminate\Database\Eloquent\Collection;

interface ObservationRepositoryInterface
{
    public function getObservationById(int $id): ?Observation;
    public function getObservationsByDonationId(int $donationId): Collection;
    public function createObservation(array $data): Observation;

}
