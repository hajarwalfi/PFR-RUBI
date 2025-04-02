<?php


namespace App\Repositories\Eloquent;

use App\Models\Serology;
use App\Repositories\Interfaces\SerologyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SerologyRepository implements SerologyRepositoryInterface
{
    protected $model;

    public function __construct(Serology $serology)
    {
        $this->model = $serology;
    }

    public function getSerologyById(int $id): ?Serology
    {
        return $this->model->find($id);
    }

    public function getSerologyByDonationId(int $donationId): ?Serology
    {
        return $this->model->where('donation_id', $donationId)->first();
    }

    public function createSerology(array $data): Serology
    {
        return $this->model->create($data);
    }

    public function updateSerology(int $id, array $data): bool
    {
        $serology = $this->getSerologyById($id);
        if (!$serology) {
            return false;
        }
        return $serology->update($data);
    }

    public function deleteSerology(int $id): bool
    {
        $serology = $this->getSerologyById($id);
        if (!$serology) {
            return false;
        }
        return $serology->delete();
    }
}
