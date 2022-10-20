@extends('layouts.app')

@section('body')

@auth
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-9 col-lg-7 col-xl-5">
          <div class="card" style="border-radius: 15px; background-color: #9de2ff;">
            <div class="card-body p-4">
              <div class="d-flex text-black">
                <div class="flex-shrink-0">
                  <img src="{{ asset('img/profile.jpg') }}"
                    alt="Generic placeholder image" class="img-fluid"
                    style="width: 180px; border-radius: 10px;">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="mb-1">{{Auth::user()->name}}</h5>
                  <p class="mb-2 pb-1" style="color: #2b2a2a;">{{Auth::user()->email}}</p>
                  <p class="mb-2 pb-1" style="color: #2b2a2a;">{{Auth::user()->phone_number}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@else
Please Login 

@endauth

@endsection