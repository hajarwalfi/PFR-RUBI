<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = $this->appointmentService->getUserAppointments(Auth::id());
        return view('User.Dashboard.appointments', compact('appointments'));
    }

    public function create()
    {
        $availableDays = $this->appointmentService->getAvailableDays();
        $availableTimes = $this->appointmentService->getAvailableTimes();

        return view('User.Appointments.create', compact('availableDays', 'availableTimes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
        ]);

        $data = $request->only(['date', 'time']);
        $data['user_id'] = Auth::id();

        $this->appointmentService->createAppointment($data);
        return redirect()->route('dashboard.appointments')
            ->with('success', 'Your appointment has been scheduled successfully.');
    }
}
