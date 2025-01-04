<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppoinmentsHistory extends Model
{
    protected $table = 'appointments_history';
    protected $fillable = [
        'date',
        'details',
        'patient_id',
        'appointment_id'

    ];

    public function medicalAppoinments()
    {
        return $this->hasMany(MedicalAppoinments::class, 'appointment_id');
    }

//    public function user()
//    {
//        return $this->hasMany(MedicalAppoinments::class, 'patient_id');
//    }
}
