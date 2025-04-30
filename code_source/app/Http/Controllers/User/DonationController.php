<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\DonationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function index()
    {
        $userId = Auth::id();
        $donations = $this->donationService->getDonationsByUserId($userId);

        return view('User.Dashboard.donations', compact('donations'));
    }

    public function show($id)
    {
        $userId = Auth::id();
        $donation = $this->donationService->getDonationById($id);

        if (!$donation || $donation->user_id !== $userId) {
            return redirect()->route('user.donations.index')
                ->with('error', 'Vous n\'êtes pas autorisé à voir cette donation.');
        }

        return view('User.Dashboard.show', compact('donation'));
    }
}
