<?php

namespace App\Http\Controllers;

use App\Models\MedicalAppoinments;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function showDoctorSelection(Request $request)
    {
        $doctors = User::role('doctor')->get();
        $selectedDate = $request->input('date', now()->toDateString());

        return view('appointments.select_date', compact('doctors', 'selectedDate'));
    }

    public function showAvailableDoctors(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $selectedDate = Carbon::parse($date);
        $doctors = User::role('doctor')->get();

        return view('appointments.select_doctor', compact('doctors', 'date'));
    }


    public function showAvailableTimes($doctorId, $date)
    {
        $doctor = User::find($doctorId);

        $schedule = Schedule::where('user_id', $doctor->id)->first();

        if (!$schedule) {
            return view('appointments.available_times', [
                'availableTimes' => [],
                'doctor' => $doctor,
                'date' => $date
            ]);
        }

        $availableTimes = [];

        $start = Carbon::parse($date . ' ' . $schedule->start_time);
        $end = Carbon::parse($date . ' ' . $schedule->end_time);

        $bookedAppointments = MedicalAppoinments::where('user_id', $doctor->id)
            ->whereDate('appointment_date', $date)
            ->get();

        while ($start->lt($end)) {
            $slotEndTime = $start->clone()->addMinutes($schedule->consultation_duration);

            $isBooked = $bookedAppointments->contains(function ($appointment) use ($start, $slotEndTime) {
                $appointmentStart = Carbon::parse($appointment->start_time);
                $appointmentEnd = Carbon::parse($appointment->end_time);

                return !($slotEndTime->lte($appointmentStart) || $start->gte($appointmentEnd));
            });

            if (!$isBooked) {
                $availableTimes[] = [
                    'start_time' => $start->format('H:i'),
                    'end_time' => $slotEndTime->format('H:i'),
                ];
            }

            $start->addMinutes($schedule->consultation_duration);
        }

        return view('appointments.available_times', compact('availableTimes', 'doctor', 'date'));
    }




    public function bookAppointment(Request $request)
    {

        $user = auth()->user();

        $startTime = Carbon::parse($request->date . ' ' . $request->start_time);
        $endTime = $startTime->clone()->addMinutes($request->consultation_duration);

        $bookedAppointments = MedicalAppoinments::where('user_id', $request->doctor_id)
            ->whereDate('appointment_date', $request->date)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        if ($bookedAppointments) {
            return redirect()->back()->with('error', 'Este horario ya no está disponible.');
        }

        $appointment = new MedicalAppoinments();
        $appointment->doctor_id = $request->doctor_id;
        $appointment->user_id = $user->id;
        $appointment->appointment_date = $request->date;
        $appointment->start_time = $startTime->format('H:i');
        $appointment->end_time = $endTime->format('H:i');
        $appointment->status = 'confirmed';
        $appointment->reason = $request->reason;
        $appointment->save();

        return redirect()->route('user.appointments', ['date' => $request->date])
            ->with('success', 'Cita reservada correctamente');
    }




    public function showAppointments()
    {
        $user = auth()->user(); // Obtener al usuario autenticado
        $appointments = $user->medicalAppointments; // Obtener las citas médicas del usuario

        return view('user.appointments', compact('appointments')); // Pasar a la vista
    }






}
