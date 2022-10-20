@extends('layouts.app')

@section('body')

<h1>{{$service->from}} &rarr; {{$service->to}} </h1>
<div class="border mt-2">
<p class="p-2">Departure Date: {{$schedule->date->format('Y-m-d')}} </p>
<p class="p-2"> Departure Time : {{$schedule->time->format('g:ia')}}</p>
<p class="p-2">Ticket Price : {{$schedule->price}} / person</p>
<p class="p-2"> Availability : {{$schedule->seat_available}} / {{$schedule->total_seat}}

<form method="POST" action="{{ route('save') }}" >
    @csrf
    <input type="hidden" name="id" value="{{$schedule->id}}">
    <input type="hidden" name="price" value="{{$schedule->price}}">
    <button class="btn btn-primary">Booking</button>
</form>

</div>


@endsection
