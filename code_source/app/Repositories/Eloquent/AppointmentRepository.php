<?php

namespace App\Repositories\Eloquent;

use App\Models\Appointment;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function getAllUpcomingAppointments()
    {
        return Appointment::with('user')
            ->upcoming()
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }

    public function createAppointment(array $data)
    {
        return Appointment::create($data);
    }

    public function getUserAppointments($userId)
    {
        return Appointment::where('user_id', $userId)
            ->upcoming()
            ->orderBy('date')
            ->orderBy('time')
            ->get();
    }
}
