<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    //

    public function list()
    {
        $bookings = DB::table('bookings')
        ->join('schedule_services', 'schedule_services.id', '=', 'bookings.schedule_service_id')
        ->join('schedules', 'schedules.id', '=', 'schedule_services.schedule_id')
        ->where('bookings.user_id', Auth::user()->id)
        ->paginate(15);

        Paginator::useBootstrapFive();

        return view('history', compact('bookings'));
    }
}
