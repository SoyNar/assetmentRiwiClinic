<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateScheduleRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;

class DoctorAvailableController extends Controller


{
    public  function showSchedule()
    {

    }

    public function generateSchedule(GenerateScheduleRequest $request)
    {

        $medico = User::find($request->doctor_id);

        if (!$medico->hasRole('doctor')) {
            return response()->json(['error' => 'El usuario seleccionado no es un médico'], 400);
        }

        $schedule = Schedule::where('user_id', $medico->id)
            ->where('date', $request->date)
            ->first();

        if (!$schedule) {
            return response()->json(['error' => 'No existe horario configurado para este médico en la fecha seleccionada'], 404);
        }

        $horarios = $this->generateScheduleFromTable($schedule);

        foreach ($horarios as $hora) {
            Schedule::create([
                'user_id' => $medico->id,
                'date' => $request->date,
                'start_time' => $hora,
                'end_time' => Carbon::parse($hora)->addMinutes($schedule->duracion_cita)->format('H:i'),
                'available' => true,
            ]);
        }
        return view('schedule', [
            'schedule' => $horarios,
            'doctor' => $medico,
            'date' => $request->date
        ]);
    }

    public function generateAllSchedule(GenerateScheduleRequest $request)
    {

        $schedules = Schedule::where('date', $request->date)->get();

        if ($schedules->isEmpty()) {
            return response()->json(['error' => 'No hay horarios configurados para la fecha seleccionada'], 404);
        }

        $horariosPorMedico = [];
        foreach ($schedules as $schedule) {
            $medico = User::find($schedule->user_id);
            if ($medico->hasRole('doctor')) {
                // Generamos los horarios para este médico
                $horarios = $this->generateScheduleFromTable($schedule);

                // Guardamos los horarios generados en la base de datos
                foreach ($horarios as $hora) {
                    Schedule::create([
                        'user_id' => $schedule->user_id,
                        'date' => $request->date,
                        'start_time' => $hora,
                        'end_time' => Carbon::parse($hora)->addMinutes($schedule->duracion_cita)->format('H:i'),
                        'available' => true,
                    ]);
                }
            }
            $horariosPorMedico[$schedule->user_id] = $horarios;
        }

        return view('admin.schedule');
    }


    private function generateScheduleFromTable($schedule)
    {
        $horaInicio = Carbon::parse($schedule->hora_inicio);
        $horaFin = Carbon::parse($schedule->hora_fin);
        $duracionCita = $schedule->duracion_cita;

        $horarios = [];
        while ($horaInicio->lt($horaFin)) {
            $horarios[] = $horaInicio->format('H:i');
            $horaInicio->addMinutes($duracionCita);
        }

        return $horarios;

    }
}
