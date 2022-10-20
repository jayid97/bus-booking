@extends('layouts.app')

@section('body')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="background-color: #e3f2fd;">
                    <div class="col-12 d-flex justify-content-center">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <input id="email" class="form-control my-3 py-2" type="email" name="email" value="{{old('email', $request->email)}}" required autofocus placeholder="Email"/>

                            @if($errors->get('email'))
                            <div class="small text-danger">{{join('<br>', $errors->get('email'))}}</div>
                            @endif

                            <input id="password" class="form-control my-3 py-2" type="password" name="password" required placeholder="Password" />

                            @if($errors->get('password'))
                            <div class="small text-danger">{{join('<br>', $errors->get('password'))}}</div>
                            @endif

                            <input id="password_confirmation" class="form-control my-3 py-2"
                                    type="password"
                                    name="password_confirmation" required placeholder="Confirm Password" />

                            @if($errors->get('password_confirmation'))
                            <div class="small text-danger">{{join('<br>', $errors->get('password_confirmation'))}}</div>
                            @endif

                            <div class="text-center mt-3">
                                <button class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
