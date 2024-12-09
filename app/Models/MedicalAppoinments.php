<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MedicalAppoinments extends Model
{
    protected $table = 'medical_appointments';
    protected $fillable = [
        'note',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
