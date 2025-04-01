<?php

namespace App\Repositories\Interfaces;

interface SerologyRepositoryInterface
{
    public function getSerologyByDonationId($donationId);
    public function createSerology(array $data);
    public function updateSerology($id, array $data);
    public function deleteSerology($id);
}
