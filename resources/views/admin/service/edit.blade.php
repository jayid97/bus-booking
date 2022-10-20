@extends('layouts.admin')

@section('body')
@if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger mt-2" role="alert">:message</div>')) !!}
@endif
@if (session('status'))
    <div class="alert alert-success mt-2">
        {{ session('status') }}
    </div>
@endif

<div class="container p-4 mt-5" style="background-color: #CC0000; color:aliceblue;">
<div class="row">
        <div class="col-md-12">
        <h1 class="font-weight-bold text-uppercase text-center">Edit Service</h1>
        </div>
    </div>
    <div class="row">
    <form method="POST" action="{{route('admin.scheduleservices.update',['scheduleservice'=> $scheduleservice])}}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
        <div class="row">
                <label>Destination</label>
                <select name="destination" class="form-control my-2">      
                    <option value="{{$scheduleservice->id}}">{{$scheduleservice->schedule->from}} -> {{$scheduleservice->schedule->to}} </option>
                    @foreach($schedule as $s)
                    <option value="{{$s->id}}">{{$s->from}} -> {{$s->to}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="row">
                <label>Total Seat</label>
                <input name="total_seat" type="text" class="form-control my-2" value="{{$scheduleservice->total_seat}}"/>
                </div>
                <div class="row">
                <label>Price</label>
                <input name="price" type="text" class="form-control my-2" value="{{$scheduleservice->price}}"/>
                </div>
                <div class="row">
                <label>Date</label>
                <input name="date" type="date" class="form-control my-2" value="{{$scheduleservice->date->format('Y-m-d')}}"/>
                </div>
                <div class="row">
                <label>Time</label>
                <input name="time" type="time" class="form-control my-2" value="{{$scheduleservice->time->format('H:i:s')}}"/>
                </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-submit btn-outline-light">Edit Service</button>
                </div>
            </div>
                
            </div>
        </form>
        </div>
    </div>
    
</div>
@endsection