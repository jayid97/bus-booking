<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AdminSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrapFive();
        $schedules = Schedule::where('status', 1)->paginate(15);
        $locations = Location::get();
        return view('admin.schedule.index', compact('schedules', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
                'from' => 'required',
                'to' => ['required','different:from'],
            ]
        );

        $checking = Schedule::where('from', $request->from)
        ->where('to', $request->to)->get();

        if($checking->count() > 0)
        {
            return redirect()->back()->withErrors(["Unable to add same destination {$request->from} -> {$request->to}"]);
        }

        Schedule::create([
            'from' => $request->from,
            'to' => $request->to,
            'status' => 1,
        ]);

        return redirect()->back()->with('status', 'Add New Schedule Success!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $locations = Location::get();
        return view('admin.schedule.edit', compact('schedule', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate(
            [
                'from' => 'required',
                'to' => ['required','different:from'],
            ]
        );

        $checking = Schedule::where('from', $request->from)
        ->where('to', $request->to)->get();

        if($checking->count() > 0)
        {
            return redirect()->back()->withErrors(["Unable to update to same destination {$request->from} -> {$request->to}"]);
        }

        DB::table('schedules')
              ->where('id', $schedule->id)
              ->update([
                'from' => $request->from,
                'to' => $request->to,        
            ]);

        return redirect()->back()->with('status', 'Update Schedule Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
        DB::table('schedules')
              ->where('id', $schedule->id)
              ->update([
                'status' => 0       
            ]);
        return redirect()->back()->with('status', 'Delete Schedule Success!');
    }
}
