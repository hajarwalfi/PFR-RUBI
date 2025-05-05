<?php

namespace App\Repositories\Interfaces;

interface AppointmentRepositoryInterface
{
    public function getAllUpcomingAppointments();
    public function createAppointment(array $data);
    public function getUserAppointments($userId);
}
