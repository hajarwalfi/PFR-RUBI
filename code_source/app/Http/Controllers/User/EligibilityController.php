<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\EligibilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EligibilityController extends Controller
{
    protected $eligibilityService;

    public function __construct(EligibilityService $eligibilityService)
    {
        $this->eligibilityService = $eligibilityService;
        $this->middleware('auth');
    }

    public function showEligibilityForm()
    {
        $user = Auth::user();

        return view('User.Eligibility.index', [
            'user' => $user
        ]);
    }


    public function checkEligibility(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to check your eligibility.');
        }

        $validated = $request->validate([
            'age' => 'required|string|in:under18,18to65,over65',
            'weight' => 'required|string|in:under50kg,over50kg',
            'recent_illness' => 'required|string|in:yes,no',
            'previous_donation' => 'required|string|in:yes,no',
            'medical_condition' => 'required|string|in:heart_disease,diabetes,hepatitis,hiv,none',
        ]);

        // Convertir medical_condition en tableau pour maintenir la compatibilité avec le service existant
        $validated['conditions'] = [$validated['medical_condition']];

        $result = $this->eligibilityService->checkEligibility($validated);

        return view('User.Eligibility.result', [
            'isEligible' => $result['is_eligible'],
            'reason' => $result['reason'],
            'user' => Auth::user()
        ]);
    }

    public function showHistory()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your history.');
        }

        $user = Auth::user();
        $history = $this->eligibilityService->getUserEligibilityHistory($user->id);

        return view('User.eligibility.history', [
            'history' => $history,
            'user' => $user
        ]);
    }
}
