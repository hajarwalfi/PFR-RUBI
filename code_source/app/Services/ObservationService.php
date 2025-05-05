<?php


namespace App\Services;

use App\Repositories\Interfaces\ObservationRepositoryInterface;
use App\Models\Observation;
use Illuminate\Database\Eloquent\Collection;

class ObservationService
{
    protected ObservationRepositoryInterface $observationRepository;

    public function __construct(ObservationRepositoryInterface $observationRepository)
    {
        $this->observationRepository = $observationRepository;
    }

    public function getObservationById(int $id): ?Observation
    {
        return $this->observationRepository->getObservationById($id);
    }

    public function getObservationsByDonationId(int $donationId): Collection
    {
        return $this->observationRepository->getObservationsByDonationId($donationId);
    }

    public function createObservation(array $data): Observation
    {
        return $this->observationRepository->createObservation($data);
    }

}
