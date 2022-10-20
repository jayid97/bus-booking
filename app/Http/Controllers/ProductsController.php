<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    function show($id)
    {
        $user = User::find($id);
        return view('product')->with(['user' => $user]);
    }
}
