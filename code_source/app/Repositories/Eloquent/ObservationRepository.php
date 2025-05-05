<?php


namespace App\Repositories\Eloquent;

use App\Models\Observation;
use App\Repositories\Interfaces\ObservationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ObservationRepository implements ObservationRepositoryInterface
{
    protected $model;

    public function __construct(Observation $observation)
    {
        $this->model = $observation;
    }

    public function getObservationById(int $id): ?Observation
    {
        return $this->model->find($id);
    }

    public function getObservationsByDonationId(int $donationId): Collection
    {
        return $this->model->where('donation_id', $donationId)->get();
    }

    public function createObservation(array $data): Observation
    {
        return $this->model->create($data);
    }


}
