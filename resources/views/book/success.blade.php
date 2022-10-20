@extends('layouts.app')

@section('body')
<div class="container p-4 mt-5" style="background-color: DodgerBlue; color:aliceblue;">
    <div class="row">
        <div class="col-md-12">
        <h1 class="font-weight-bold text-uppercase text-center">Booking Receipt</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
            <div class="contactform">
                <div class="row">
                <div class="col-md-6">
                    <label class="my-2" >Order Number : #{{$booking->id}}</label>
                </div>
                <br>
                <div class="col-md-6">
                    <label class="my-2" >Time : {{$booking->time}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="my-2" >Name : {{$booking->user->name}}</label>
                </div>
                <br>
                <div class="col-md-6">
                    <label class="my-2" >Email : {{$booking->user->email}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="my-2" >Amount : RM{{ number_format($booking->payment_amount,2)}}</label>
                </div>
                <br>
                <div class="col-md-6">
                    <label class="my-2" >Date : {{$booking->date}}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-submit btn-outline-light">Print</button>
                </div>
            </div>
                
            </div>
        </div>
    </div>
    
</div>

@endsection
