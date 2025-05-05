<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $appointments = $this->appointmentService->getAllUpcomingAppointments();

        // Group appointments by date for easier display
        $appointmentsByDate = $appointments->groupBy(function($appointment) {
            return $appointment->date->format('Y-m-d');
        });

        return view('Admin.Appointments.index', compact('appointmentsByDate'));
    }
}
