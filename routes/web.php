<?php

//use App\Http\Controllers\DoctorAvailableController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/schedule', [DoctorAvailableController::class, 'generateSchedule'])->name('generate-schedule');
Route::get('/schedule/all', [ScheduleController::class, 'showSchedule'])->name('show.allschedule');
Route::post('/schedule/all', [ScheduleController::class, 'showSchedule'])->name('generate.allschedule');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
