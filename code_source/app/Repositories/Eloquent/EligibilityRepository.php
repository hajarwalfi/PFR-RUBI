<?php

namespace App\Repositories\Eloquent;

use App\Models\Eligibility;
use App\Repositories\Interfaces\EligibilityRepositoryInterface;

class EligibilityRepository implements EligibilityRepositoryInterface
{

    public function getEligibilityCheckById($id)
    {
        return Eligibility::findOrFail($id);
    }

    public function getEligibilityChecksByUserId($userId)
    {
        return Eligibility::where('user_id', $userId)->get();
    }


    public function createEligibilityCheck(array $eligibilityDetails)
    {
        return Eligibility::create($eligibilityDetails);
    }

}
