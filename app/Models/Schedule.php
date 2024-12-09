<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;


    protected $table = 'schedule';
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'consultation_duration',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
