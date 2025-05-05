<?php

namespace App\Services;

use App\Repositories\Interfaces\AppointmentRepositoryInterface;

class AppointmentService
{
    protected AppointmentRepositoryInterface $appointmentRepository;

    public function __construct(
        AppointmentRepositoryInterface $appointmentRepository
    ) {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getAllUpcomingAppointments()
    {
        return $this->appointmentRepository->getAllUpcomingAppointments();
    }

    public function createAppointment(array $data)
    {
        return $this->appointmentRepository->createAppointment($data);
    }

    public function getUserAppointments($userId)
    {
        return $this->appointmentRepository->getUserAppointments($userId);
    }

    public function getAvailableDays()
    {
        $days = [];
        $today = now();

        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->addDays($i);
            $days[] = [
                'value' => $date->format('Y-m-d'),
                'label' => $date->format('l, F j, Y')
            ];
        }

        return $days;
    }

    public function getAvailableTimes()
    {
        $times = [];
        $startTime = 9;
        $endTime = 17;

        for ($hour = $startTime; $hour < $endTime; $hour++) {
            $timeString = sprintf('%02d:00', $hour);
            $displayTime = date('h:i A', strtotime($timeString));

            $times[] = [
                'value' => $timeString,
                'label' => $displayTime
            ];
        }

        return $times;
    }
}
