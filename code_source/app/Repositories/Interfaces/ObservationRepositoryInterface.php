<?php

namespace App\Repositories\Interfaces;

interface ObservationRepositoryInterface
{
    public function getObservationsByDonationId($donationId);
    public function createObservation(array $data);
    public function updateObservation($id, array $data);
    public function deleteObservation($id);
}
