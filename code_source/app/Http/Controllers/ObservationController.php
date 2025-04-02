<?php


namespace App\Http\Controllers;

use App\Services\ObservationService;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    protected $observationService;

    public function __construct(ObservationService $observationService)
    {
        $this->observationService = $observationService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'comment' => 'required|string',
        ]);

        $observation = $this->observationService->createObservation($validated);

        return redirect()->back()->with('success', 'Observation ajoutée avec succès.');
    }
}
