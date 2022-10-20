<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    function dashboard()
    {
        $dailysales = [];
        $lastmonth = \Carbon\Carbon::today()->subMonths(1);
        foreach(Booking::where('created_at', '>=', $lastmonth)->orderBy('created_at', 'desc')->get() as $row)
        {
            $dt = $row->created_at->format('Y-m-d');
            if(isset($dailysales[$dt]))
            {
                $dailysales[$dt] += $row->payment_amount;
            }else{
                $dailysales[$dt] = $row->payment_amount;
            }
        }

        return view('admin.dashboard', compact('dailysales'));
    }
}
