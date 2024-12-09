<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MedicalAppoinments extends Model
{
    protected $fillable = [
        'note',
        'appointment_Date',
        'start_time',
        'end_time',
        'status',
        'reason',
    ];

//Duración fija de 40 minutos
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->end_time = Carbon::parse($appointment->start_time)
                ->addMinutes(40)
                ->format('Y-m-d H:i:s');
        });
    }

    // Validación de disponibilidad
    public function checkAvailability()
    {
        // Verificar que no haya otras citas en el mismo intervalo
        return !MedicalAppoinments::where('doctor_id', $this->doctor_id)
            ->where(function($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                    ->orWhereBetween('end_time', [$this->start_time, $this->end_time]);
            })
            ->exists();
    }

}
