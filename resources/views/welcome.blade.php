@extends('layouts.app')

@section('body')
@if($errors->any())
    {!! implode('', $errors->all('<div class="alert alert-danger mt-2" role="alert">:message</div>')) !!}
@endif
<div class="container p-4 mt-5" style="background-color: DodgerBlue; color:aliceblue;">
    <div class="row">
        <div class="col-md-12">
        <h1 class="font-weight-bold text-uppercase text-center">Booking</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <span id="lblResponse" class="tab-content"></span>
                    </div>
                </div>
                <form method="GET" action="{{route('schedules')}}">
                <div class="row">
                <div class="col-md-3">
                  <label>From</label>
                  <select id="from" name="from" class="form-control my-2">
                    @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
                </div>
                <br>
                <div class="col-md-3">
                  <label>To</label>
                <select id="to" name="to" class="form-control my-2">
                  @foreach($locations as $loc)
                    <option value="{{$loc->state}}">{{$loc->state}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control my-2" name="date" value="{{ old('date')}}"/>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-submit btn-outline-light my-4">Find</button>
                </div>
                </form>
</div>
                
            </div>
        </div>
    </div>
    
</div>
  
</div>
@endsection

