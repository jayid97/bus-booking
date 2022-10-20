<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'status',
    ];

    public $timestamps = false;


    function services()
    {
        return $this->hasMany(ScheduleService::class);
    }
}
