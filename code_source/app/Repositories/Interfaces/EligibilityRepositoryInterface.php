<?php

namespace App\Repositories\Interfaces;

interface EligibilityRepositoryInterface
{
    public function getEligibilityCheckById($id);
    public function createEligibilityCheck(array $eligibilityDetails);
    public function getEligibilityChecksByUserId($userId);

}
