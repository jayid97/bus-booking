@extends('layouts.app')

@section('body')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="background-color: #e3f2fd;">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mb-4 text-sm text-gray-600">
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf
                                <input id="password" class="form-control my-3 py-2"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="Password"/>

                                @if($errors->get('password'))
                                <div class="small text-danger">{{join('<br>', $errors->get('password'))}}</div>
                                @endif
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

