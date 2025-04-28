<?php

namespace App\Services;

use App\Repositories\Interfaces\EligibilityRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EligibilityService
{
    protected $eligibilityRepository;

    public function __construct(EligibilityRepositoryInterface $eligibilityRepository)
    {
        $this->eligibilityRepository = $eligibilityRepository;
    }

    public function checkEligibility(array $data)
    {
        $isEligible = true;
        $ineligibilityReason = null;

        // Vérifier l'âge
        if ($data['age'] === 'under18' || $data['age'] === 'over65') {
            $isEligible = false;
            $ineligibilityReason = 'Age requirements not met. Donors must be between 18-65 years old.';
        }

        // Vérifier le poids
        if ($data['weight'] === 'under50kg') {
            $isEligible = false;
            $ineligibilityReason = 'Weight requirements not met. Donors must weigh at least 50kg (110 lbs).';
        }

        // Vérifier la maladie récente
        if ($data['recent_illness'] === 'yes') {
            $isEligible = false;
            $ineligibilityReason = 'You cannot donate if you have been ill in the past 14 days.';
        }

        // Vérifier le don précédent
        if ($data['previous_donation'] === 'yes') {
            $isEligible = false;
            $ineligibilityReason = 'You must wait at least 8 weeks between blood donations.';
        }

        $medicalConditions = $data['conditions'] ?? [];
        if (in_array('none', $medicalConditions, true) && count($medicalConditions) > 1) {
            $medicalConditions = ['none'];
        }
        if (in_array('heart_disease', $medicalConditions, true) ||
            in_array('hepatitis', $medicalConditions, true) ||
            in_array('hiv', $medicalConditions, true)) {
            $isEligible = false;
            $ineligibilityReason = 'Medical conditions prevent donation. Please consult with a healthcare professional.';
        }

        $eligibilityData = [
            'user_id' => Auth::id(),
            'age_group' => $data['age'],
            'weight_group' => $data['weight'],
            'recent_illness' => $data['recent_illness'],
            'previous_donation' => $data['previous_donation'],
            'medical_conditions' => $medicalConditions,
            'is_eligible' => $isEligible,
            'ineligibility_reason' => $ineligibilityReason,
            'check_date' => now()
        ];

        $eligibilityCheck = $this->eligibilityRepository->createEligibilityCheck($eligibilityData);

        return [
            'eligibility' => $eligibilityCheck,
            'is_eligible' => $isEligible,
            'reason' => $ineligibilityReason
        ];
    }

    public function getUserEligibilityHistory($userId = null)
    {
        $userId = $userId ?? Auth::id();

        if (!$userId) {
            return collect();
        }

        return $this->eligibilityRepository->getEligibilityChecksByUserId($userId);
    }
}
