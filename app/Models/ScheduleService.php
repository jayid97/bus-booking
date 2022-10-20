<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleService extends Model
{
    use HasFactory;


    protected $fillable = [
        'schedule_id',
        'total_seat',
        'seat_available',
        'status',
        'price',
        'date',
        'time',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    function bookings(){
        return $this->hasMany(Booking::class);
    }
    
}
