<?php

//use App\Http\Controllers\DoctorAvailableController;
use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/schedule', [DoctorAvailableController::class, 'generateSchedule'])->name('generate-schedule');
Route::get('/schedule/all', [ScheduleController::class, 'showSchedule'])->name('show.allschedule');
Route::post('/schedule/all', [ScheduleController::class, 'generateSchedule'])->name('generate.allschedule');
Route::get('/schedules', [ScheduleController::class, 'indexSchedule'])->name('schedules.index');


Route::get('/select-date', [PatientController::class, 'showDoctorSelection'])
    ->name('appointments.selectDate');
Route::get('/appointments/times/{doctorId}/{date}', [PatientController::class, 'showAvailableTimes'])
    ->name('appointments.showTimes');
Route::post('/appointments/book', [PatientController::class, 'bookAppointment'])->name('appointments.bookAppointment');
Route::get('/appointments/doctors', [PatientController::class, 'showAvailableDoctors'])
    ->name('appointments.showDoctors');

Route::put('/horarios/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/horarios/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
Route::patch('/horarios/{id}/restore', [ScheduleController::class, 'restore'])->name('schedule.restore');




Route::get('/user/appointments', [PatientController::class, 'showAppointments'])->name('user.appointments');



Route::get('/register-doctor', [DoctorAuthController::class, 'showFormRegister'])->name('register.show-doctor');
Route::post('/register-doctor', [DoctorAuthController::class, 'registerDoctor'])->name('register.doctor');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole('patient')) {
            return redirect()->route('user.appointments');
        }
        return view('dashboard');
    })->name('dashboard');
});
