@extends('layouts.app')

@section('body')
<div class="container p-4 mt-5" style="background-color: DodgerBlue; color:aliceblue;">
    <div class="row">
        <div class="col-md-12">
        <h1 class="font-weight-bold text-uppercase text-center">Contact-Us</h1>
        <p class="lead text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Bioenergy Projects Sdn Bhd.</h3>
            <p>No. 8, Jalan Laguna 1 ,
        13700 Perai, Pulau Pinang</p>
            <h3>Call Us</h3>
            <p>+604 384 2088 / 2988 2190</p>
            <h3>Email Us</h3>
            <p>sales@bio-energy.com.my</p>
        </div>
        <div class="col-md-8">
            <div class="contactform">
                <div class="row">
                    <div class="col-md-8">
                        <span id="lblResponse" class="tab-content"></span>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control my-2" placeholder="Name">
                </div>
                <br>
                <div class="col-md-6">
                    <input type="email" class="form-control my-2" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control my-2" placeholder="Subject">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea rows="10" cols="20" cols="30" class="form-control my-2" placeholder="Message"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-submit btn-outline-light">Send Message</button>
                </div>
            </div>
                
            </div>
        </div>
    </div>
    
</div>

@endsection
