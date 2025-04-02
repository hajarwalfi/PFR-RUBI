<?php


namespace App\Repositories\Eloquent;

use App\Models\Donation;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DonationRepository implements DonationRepositoryInterface
{
    protected $model;

    public function __construct(Donation $donation)
    {
        $this->model = $donation;
    }

    public function getAllDonations(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->model->with(['user', 'serology', 'observations']);

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['type'])) {
            $query->where('type', 'like', '%' . $filters['type'] . '%');
        }

        if (isset($filters['date_from'])) {
            $query->whereDate('date', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->whereDate('date', '<=', $filters['date_to']);
        }

        if (isset($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('identifier', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%')
                            ->orWhere('cni', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query->orderBy('date', 'desc')->paginate($perPage);
    }

    public function getDonationById(int $id): ?Donation
    {
        return $this->model->find($id);
    }

    public function getDonationsByUserId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)
            ->with(['serology', 'observations'])
            ->orderBy('date', 'desc')
            ->get();
    }

    public function createDonation(array $data): Donation
    {
        return $this->model->create($data);
    }

    public function updateDonation(int $id, array $data): bool
    {
        $donation = $this->getDonationById($id);
        if (!$donation) {
            return false;
        }
        return $donation->update($data);
    }

    public function deleteDonation(int $id): bool
    {
        $donation = $this->getDonationById($id);
        if (!$donation) {
            return false;
        }
        return $donation->delete();
    }

    public function getLatestDonations(int $limit = 5): Collection
    {
        return $this->model->with(['user', 'serology'])
            ->orderBy('date', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getDonationWithRelations(int $id, array $relations = []): ?Donation
    {
        return $this->model->with($relations)->find($id);
    }
}
