<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebpageController extends Controller
{
    //

    function welcome(){
        $locations = Location::get();
        return view('welcome')->with(['locations' => $locations]);
    }

    function contactUs()
    {
        return view('contact-us');
    }

    function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('profile')->with(['user' => $user]);
    }

}
