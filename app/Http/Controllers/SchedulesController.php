<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleService;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    //
    function list(Request $request){
        //do validation
        $request->validate(
            [
                'from' => 'required',
                'to' => ['required','different:from'],
                'date' => ['required','after_or_equal:today'],
            ]
        );

        //A->B not available
        $schedule = Schedule::where('from', $request->from)
                 ->where('to', $request->to)
                 ->where('status', 1)
                 ->first();

                 if(!$schedule)
                 {
                    return redirect()->back()->withErrors("No available schedule for {$request->from} -> {$request->to}");
                 }

        //Date not available
                 $services = $schedule->services()
                 ->where('date', $request->date)
                 ->get();

        //
                 
                 if($services->count() <= 0)
                 {
                    return redirect()->back()->withErrors(["No available service on {$request->date}"]);
                 }
        return view('schedule', compact('services', 'schedule'));
    }

}
