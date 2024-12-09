<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Foundation\Auth\User;

class DoctorSchedulService{

    public function generateGlobalAvailableSlots()
    {
        // Obtener configuración global
        $globalSettings = Schedule::first();

        if (!$globalSettings) {
            throw new \Exception('No se encontró la configuración global.');
        }

        // Obtener todos los doctores
        $doctors = User::role('Doctor')->get();

        foreach ($doctors as $doctor) {
            // Limpiar slots existentes del doctor
            Schedule::where('doctor_id', $doctor->id)->delete();

            // Decodificar días de trabajo
            $workDays = json_decode($globalSettings->days_of_work, true);

            // Generar slots para los próximos 30 días
            $startDate = now();
            $endDate = now()->addDays(30);

            while ($startDate <= $endDate) {
                if (in_array(strtolower($startDate->format('l')), $workDays)) {
                    $this->createSlotsForDayWithSettings($doctor, $startDate, $globalSettings);
                }
                $startDate->addDay();
            }
        }
    }


}
