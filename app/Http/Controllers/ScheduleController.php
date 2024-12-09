<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ScheduleController extends Controller

{

    public function indexSchedule()
    {

        $horarios = Schedule::with('user')->get();

        return view('admin.index-schedule', compact('horarios'));
    }

    public function showSchedule( )

   {

       $doctors = User::role('doctor')->get();


       return view('admin.schedule', ['doctors' => $doctors]);
   }

    public function generateSchedule(GenerateScheduleRequest $request)
    {
        $medico = User::find($request->doctor_id);

        if (!$medico->hasRole('doctor')) {
            return response()->json(['error' => 'El usuario seleccionado no es un médico'], 400);
        }

        $duracionCita = (int) $request->input('consultation_duration');
        $horaInicio = Carbon::parse($request->start_time);
        $horaFin = Carbon::parse($request->end_time);

        $schedule = new Schedule();
        $schedule->user_id = $medico->id;
        $schedule->start_time = $horaInicio->format('H:i');
        $schedule->end_time = $horaFin->format('H:i');
        $schedule->consultation_duration = $duracionCita;
        $schedule->available = true;
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Horario creado exitosamente.');
    }




//    private function generateScheduleFromTable($schedule)
//    {
//        $horaInicio = Carbon::parse($schedule->hora_inicio);
//        $horaFin = Carbon::parse($schedule->hora_fin);
//        $duracionCita = $schedule->duracion_cita;
//
//        $horarios = [];
//        while ($horaInicio->lt($horaFin)) {
//            $horarios[] = $horaInicio->format('H:i');
//            $horaInicio->addMinutes($duracionCita);
//        }
//
//        return $horarios;
//
//    }

}
