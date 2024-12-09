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




    public function update(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'consultation_duration' => 'required|integer|min:1',
            'available' => 'required|boolean',
        ]);

        $horario = Schedule::findOrFail($id);

        $horario->start_time = $request->start_time;
        $horario->end_time = $request->end_time;
        $horario->consultation_duration = $request->consultation_duration;
        $horario->available = $request->available;

+        $horario->save();

        return response()->json(['success' => true, 'message' => 'Horario actualizado con éxito.']);
    }

    public function destroy($id)
    {
        $horario = Schedule::findOrFail($id);

        $horario->delete();

        return response()->json(['success' => true, 'message' => 'Horario eliminado con éxito.']);
    }

    public function restore($id)
    {
        $horario = Schedule::withTrashed()->findOrFail($id);

        $horario->restore();

        return response()->json(['success' => true, 'message' => 'Horario restaurado con éxito.']);
    }



}
