


@extends('layouts.app')

@section('body')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="background-color: #e3f2fd;">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}

                                                
                            <!-- Session Status -->
                            {{session('status')}}

                            
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <input id="email" class="form-control my-3 py-2" type="email" name="email" value="{{old('email')}}" required autofocus placeholder="Email" />

                            @if($errors->get('email'))
                            <div class="small text-danger">{{join('<br>', $errors->get('email'))}}</div>
                            @endif
                        </form>

                        <div class="text-center mt-3">
                        <button class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
                        </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

@endsection
