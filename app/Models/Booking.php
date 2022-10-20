<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_service_id',
        'payment_gateway',
        'payment_gateway_status',
        'payment_amount',
        'status'
    ];

    function service()
    {
        return $this->belongsTo(ScheduleService::class, 'schedule_service_id','id');
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::saved(function ($booking){
            $booking->updateAvailableSeats();
        });
    }

    public function updateAvailableSeats()
    {
        $service = $this->service;
        $no_of_booking = Booking::where('schedule_service_id', $service->id)->whereNot('status', 'Cancelled')->count();
        $service->seat_available = ($service->total_seat - $no_of_booking);
        $service->save();
    }
}
