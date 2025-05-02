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
        $donations = $this->donationService->getDonationsByUserId($userId, 6);

        $totalDonations = $donations->total();

        return view('User.Dashboard.donations', compact('donations', 'totalDonations'));
    }
}
