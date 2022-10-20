<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminScheduleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = ScheduleService::paginate(15);
        $schedule = Schedule::get();
        return view('admin.service.index', compact('service', 'schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'destination' => 'required',
                'total_seat' => 'required|numeric|min:20|max:30',
                'price' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]
        );

        ScheduleService::create([
            'schedule_id' => $request->destination,
            'total_seat' => $request->total_seat,
            'price' => $request->price,
            'date' => $request->date,
            'time' => $request->time,
            'seat_available' => $request->total_seat
        ]);

        return redirect()->back()->withStatus('Add New Service Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScheduleService  $scheduleService
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleService $scheduleService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduleService  $scheduleService
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleService $scheduleservice)
    {
        $schedule = Schedule::get();
        return view('admin.service.edit', compact('scheduleservice', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduleService  $scheduleService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'destination' => 'required',
                'total_seat' => 'required|numeric|min:20|max:30',
                'price' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]
        );

        DB::table('schedule_services')
              ->where('id', $id)
              ->update([
                'total_seat' => $request->total_seat,
                'price' => $request->price,
                'date' => $request->date,
                'time' => $request->time,        
            ]);

        return redirect()->back()->withStatus('Update Service Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduleService  $scheduleService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleService $scheduleservice)
    {
        //
        DB::table('schedule_services')
        ->where('id', $scheduleservice->id)
        ->delete();
        return redirect()->route('admin.scheduleservices.index')->with('status', 'Delete Services Success!');
    }
}
