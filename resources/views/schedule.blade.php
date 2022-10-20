@extends('layouts.app')

@section('body')
<h4 class="my-4">{{$schedule->from}} &rarr; {{$schedule->to}}</h4>
<table class="table mt-5">
  <thead class="table-dark">
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Depature</th>
      <th scope="col">Price</th>
      <th scope="col">Total Seat</th>
      <th scope="col">Seat Available</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($services as $service)
    <tr>
      
      <td>{{$service->date->format('Y-m-d')}}</td>
      <td>{{$service->time->format('g:ia')}}</td>
      <td>RM{{ number_format($service->price,2)}}</td>
      <td>{{$service->total_seat}}</td>
      <td>{{$service->seat_available}}</td>
      <td><a class="btn btn-primary" onclick="return confirm('Are you sure want to book?')" href="{{ route('form', ['id' => $service->id])}}">Book</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
