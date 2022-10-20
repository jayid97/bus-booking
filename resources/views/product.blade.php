@extends('layouts.app')

@section('body')
    @if(!$user)
    <div class="container">
        <h1>No User</h1>
    </div>
    @else
    <div class="container">
        <b>Name:</b> {{$user->name}} <br>
        <b>Email:</b> {{$user->email}} <br>
        <b>Phone:</b> {{$user->phone_number}}<br>
    </div>

    @endif
    @endsection
    
   