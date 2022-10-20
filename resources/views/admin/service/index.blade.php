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
<h1>Schedule Service</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Service
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{route('admin.scheduleservices.store')}}">
        @csrf
      <div class="modal-body">
      <div class="col-md-12">
                <div class="row">
                <label>Destination</label>
                <select name="destination" class="form-control my-2">
                    @foreach($schedule as $s)
                    <option value="{{$s->id}}">{{$s->from}} -> {{$s->to}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="row">
                <label>Total Seat</label>
                <input name="total_seat" type="text" class="form-control my-2" value="{{old('total_seat')}}"/>
                </div>
                <div class="row">
                <label>Price</label>
                <input name="price" type="text" class="form-control my-2" value="{{old('price')}}"/>
                </div>
                <div class="row">
                <label>Date</label>
                <input name="date" type="date" class="form-control my-2" value="{{old('date' , date('Y-m-d'))}}"/>
                </div>
                <div class="row">
                <label>Time</label>
                <input name="time" type="time" class="form-control my-2" value="{{old('time')}}"/>
                </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-submit">Add Service</button>
      </div>
      </form>
    </div>
  </div>
</div>
<table class="table mt-5">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Destination</th>
      <th scope="col">Total Seat</th>
      <th scope="col">Seat Available</th>
      <th scope="col">Price</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($service as $u)
    <tr>
      
      <td>{{$u->id}}</td>
      <td>{{$u->schedule->from}} -> {{$u->schedule->to}}</td>
      <td>{{$u->total_seat}}</td>
      <td>{{$u->seat_available}}</td>
      <td> 
      RM{{number_format($u->price,2)}}
      </td>
      <td> 
      {{$u->date->format('Y-m-d')}}
      </td>
      <td> 
      {{$u->time->format('g:ia')}}
      </td>
      <td>
      <div class="d-flex">
      <a class="btn btn-small btn-info m-1" href="{{ route('admin.scheduleservices.edit',['scheduleservice'=> $u]) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
        </svg>
      </a> 
      <form method="POST" action="{{route('admin.scheduleservices.destroy', ['scheduleservice'=> $u])}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-small btn-info m-1" onclick="return confirm('Are you sure want to delete the service?')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg>
        </button>
      </form>
      </div>
      </td>
    @endforeach
  </tbody>
  {{$service->links()}}
@endsection