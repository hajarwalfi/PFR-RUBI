<?php

namespace App\Repositories\Interfaces;

interface EligibilityRepositoryInterface
{
    public function getAllEligibilityChecks();
    public function getEligibilityCheckById($id);
    public function getEligibilityChecksByUserId($userId);
    public function deleteEligibilityCheck($id);
    public function createEligibilityCheck(array $eligibilityDetails);
    public function updateEligibilityCheck($id, array $newDetails);
}
