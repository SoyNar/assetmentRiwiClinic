<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
   public function showSchedule( )

   {

       // Obtener todos los médicos que tienen el rol 'doctor'
       $doctors = User::role('doctor')->get();


       // Mostrar la vista con el formulario para generar los horarios
       return view('admin.schedule', ['doctors' => $doctors]);
   }

    public function generateSchedule(GenerateScheduleRequest $request )
    {
        // Obtener el médico
        $medico = User::find($request->doctor_id);


        // Verificar si el usuario tiene el rol de médico
        if (!$medico->hasRole('doctor')) {
            return response()->json(['error' => 'El usuario seleccionado no es un médico'], 400);
        }

        $existingSchedules = Schedule::where('user_id', $medico->id)->get();


        // Si no existe el horario, devolver un error
        if ($existingSchedules->isNotEmpty()) {
            return response()->json(['error' => 'Este médico ya tiene horarios configurados.'], 400);
        }
        $horaInicio = Carbon::parse($request->start_time);
        $horaFin = Carbon::parse($request->end_time);
        $duracionCita = $request->duration;

        // Crear los horarios en la base de datos
        $horarios = [];
        while ($horaInicio->lt($horaFin)) {
            $horarios[] = [
                'user_id' => $medico->id,
                'start_time' => $horaInicio->format('H:i'),
                'end_time' => $horaInicio->clone()->addMinutes($duracionCita)->format('H:i'),
                'available' => true,
            ];
            $horaInicio->addMinutes($duracionCita);
        }

        // Guardar horarios en la base de datos
        Schedule::insert($horarios);


        // Redirigir a la vista de éxito (puedes redirigir o mostrar un mensaje de éxito)
        return redirect()->route('admin.schedule')->with('success', 'Horarios generados exitosamente');
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
