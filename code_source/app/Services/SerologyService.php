<?php

namespace App\Services;

use App\Repositories\Interfaces\SerologyRepositoryInterface;
use App\Models\Serology;

class SerologyService
{
    protected $serologyRepository;

    public function __construct(SerologyRepositoryInterface $serologyRepository)
    {
        $this->serologyRepository = $serologyRepository;
    }

    public function getSerologyById(int $id): ?Serology
    {
        return $this->serologyRepository->getSerologyById($id);
    }

    public function getSerologyByDonationId(int $donationId): ?Serology
    {
        return $this->serologyRepository->getSerologyByDonationId($donationId);
    }

    public function createSerology(array $data): Serology
    {
        return $this->serologyRepository->createSerology($data);
    }

    public function updateSerology(int $id, array $data): bool
    {
        return $this->serologyRepository->updateSerology($id, $data);
    }

    public function deleteSerology(int $id): bool
    {
        return $this->serologyRepository->deleteSerology($id);
    }
}
