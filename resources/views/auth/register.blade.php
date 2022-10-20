@extends('layouts.app')

@section('body')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="background-color: #e3f2fd;">
                    <div class="col-12 d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                          </svg>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--name-->
                        <input id="name" class="form-control my-3 py-2" type="text" name="name" value="{{old('name')}}" required autofocus placeholder="Name" />
                        @if($errors->get('name'))
                        <div class="small text-danger">{{join('<br>', $errors->get('name'))}}</div>
                        @endif

                        <!--email-->
                        <input id="email" class="form-control my-3 py-2" type="email" name="email" value="{{old('email')}}" required placeholder="Email" />
                        @if($errors->get('email'))
                        <div class="small text-danger">{{join('<br>', $errors->get('email'))}}</div>
                        @endif

                        <!--password-->
                        <input id="password" class="form-control my-3 py-2" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                        @if($errors->get('password'))
                        <div class="small text-danger">{{join('<br>', $errors->get('password'))}}</div>
                        @endif

                        <input id="password_confirmation" class="form-control my-3 py-2" type="password" name="password_confirmation" required placeholder="Confirm Password" />
                        @if($errors->get('password_confirmation'))
                        <div class="small text-danger">{{join('<br>', $errors->get('password_confirmation'))}}</div>
                        @endif

                        <input id="phone_number" class="form-control my-3 py-2" type="text" name="phone_number" value="{{old('phone_number')}}" placeholder="Phone Number" required />
                        @if($errors->get('phone_number'))
                        <div class="small text-danger">{{join('<br>', $errors->get('phone_number'))}}</div>
                        @endif


                        <a class="underline text-sm text-gray-600 hover:text-gray-900 my-3 py-2" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <div class="text-center mt-3">
                            <button class="btn btn-primary ">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection
