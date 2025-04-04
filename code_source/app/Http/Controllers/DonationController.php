<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Services\DonationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    protected DonationService $donationService;
    protected UserService $userService;

    public function __construct(DonationService $donationService, UserService $userService)
    {
        $this->donationService = $donationService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['user_id', 'type', 'date_from', 'date_to', 'location', 'search']);
        $donations = $this->donationService->getAllDonations($filters);

        return view('Admin.donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = null;

        if ($user_id) {
            $user = User::findOrFail($user_id);
        }

        return view('Admin.Users.createDonation', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'type' => 'required|string',
            'location' => 'required|string',
            'quantity' => 'nullable|numeric',
            'operator' => 'nullable|string',
            'serology.tpha' => 'nullable|in:positive,negative,pending',
            'serology.hb' => 'nullable|in:positive,negative,pending',
            'serology.hc' => 'nullable|in:positive,negative,pending',
            'serology.vih' => 'nullable|in:positive,negative,pending',
        ]);

        $donation = $this->donationService->createDonation($validated);

        return redirect()->route('Donations.show', $donation->id)
            ->with('success', 'Donation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        // Load necessary relationships if they are not already loaded
        if (!$donation->relationLoaded('serology')) {
            $donation->load(['serology', 'observations', 'user']);
        }

        return view('Admin.Users.showDonation', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $donation = $this->donationService->getDonationById($id);

        if (!$donation) {
            return redirect()->route('Donations.index')->with('error', 'Donation not found.');
        }

        return view('Admin.Users.editDonation', compact('donation'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'type' => 'required|string',
            'location' => 'nullable|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'operator' => 'nullable|string|max:255',
        ]);

        $result = $this->donationService->updateDonation($id, $validated);

        if ($result) {
            return redirect()->back()->with('success', 'Donation updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Error updating donation.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $user_id = $donation->user_id;
        $this->donationService->deleteDonation($donation->id);

        return redirect()->route('Users.show', $user_id)
            ->with('success', 'Donation deleted successfully.');
    }
}
