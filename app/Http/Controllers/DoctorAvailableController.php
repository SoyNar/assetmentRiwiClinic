<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateScheduleRequest;
use App\Models\AppoinmentsHistory;
use App\Models\MedicalAppoinments;
use App\Models\Schedule;
use Carbon\Carbon;
use Faker\Provider\Medical;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

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

    // mostrar las citas registradas del medico
    public function showAppointmentDoctor()

    {
        // obtener el doctor que esta autenticado en ese momento
        $doctor = auth()->user();

        if (!$doctor) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión.');
        }

        //obetner la citas del doctor donde el estado sea confirmed
        $appointments = MedicalAppoinments::where('doctor_id', $doctor->id)
            ->whereIn('status', [ 'confirmed','attended','pending'])
            ->get();

        // pasarla a la vista

        return view('doctor.attention',compact('appointments'));

    }

    //metodo para  que una doctora pueda cancelar una cita
    public function appointmentCancel($appointmentId)
    {
        $appointment = MedicalAppoinments::findOrFail($appointmentId);
        // cambiar status

        $appointment->update(['status'=> 'canceled']);
        return back()
            ->with('success', 'La cita ha sido cancelada correctamente.');

    }


    // metodo para mostrar el formulario que se usará para registrar una atención medica

    public  function showRegisterAttention($appointmentId)
    {
        $appointment = MedicalAppoinments::findOrFail($appointmentId);

        return view('doctor.appointment-details',compact('appointment'));

    }

    //para ver las citas programas que tiene el doctor
    // a través de esta funcionalidad el doctor marcará la cita como atendida, osea finalizada
    // cuando un paciente es atendido, se registra una entrada en appointments_history

    public function registerAttention(Request $request, $appointmentId){
      $appointment = MedicalAppoinments::findOrFail($appointmentId);
       $appointment->update([

          'symptoms'=> $request->symptoms,
           'medications'=>$request->medications,
           'treatment'=>$request->treatment,
           'status'=>'attended'
       ]);


       // vincular la informacion a la historia clinica
        AppoinmentsHistory::create([

            'appointment_id'=>$appointment->id,
            'patient_id'=>$appointment->user->id,
            'date'=>$request->date,

            'details'=>json_encode([
            'symptoms'=> $request->symptoms,
                'medications'=>$request->medications,
                'treatment'=>$request->treatment,
            ]),
        ]);


        return back()->with('success', 'Atención registrada y cita marcada como completada.');

    }

}
