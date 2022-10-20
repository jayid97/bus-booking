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
<div class="container p-4 mt-5" style="background-color: DodgerBlue; color:aliceblue;">
    <div class="row">
    <form method="POST" action="{{route('admin.schedules.update' , $schedule->id)}}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <div class="row">
            <label>From</label>
                  <select id="from" name="from" class="form-control my-2">
                  <option value="{{$schedule->from}}">{{$schedule->from}}</option>
                    @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="row">
            <label>To</label>
                  <select id="to" name="to" class="form-control my-2">
                  <option value="{{$schedule->to}}">{{$schedule->to}}</option>
                    @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-submit btn-outline-light">Edit Location</button>
                </div>
            </div>
                
            </div>
        </form>
        </div>
    </div>
    
</div>
@endsection