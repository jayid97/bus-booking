@extends('layouts.app')

@section('body')

Welcome {{Auth::user()->id}}

@endsection

