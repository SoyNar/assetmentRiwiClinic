<?php

namespace App\Models;

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
}
